<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Resource\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Playground\Crm\Models\Contact;
use Playground\Crm\Resource\Http\Requests;
use Playground\Crm\Resource\Http\Resources;

/**
 * \Playground\Crm\Resource\Http\Controllers\ContactController
 */
class ContactController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Contact',
        'model_label_plural' => 'Contacts',
        'model_route' => 'playground.crm.resource.contacts',
        'model_slug' => 'contact',
        'model_slug_plural' => 'contacts',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:contact',
        'table' => 'crm_contacts',
        'view' => 'playground-crm-resource::contact',
    ];

    /**
     * Create the Contact resource in storage.
     *
     * @route GET /resource/crm/contacts/create playground.crm.resource.contacts.create
     */
    public function create(
        Requests\Contact\CreateRequest $request
    ): JsonResponse|View|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact = new Contact($validated);

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $contact,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $contact->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        if (! $request->session()->has('errors')) {
            session()->flashInput($flash);
        }

        return view(sprintf('%1$s/form', $this->packageInfo['view']), $data);
    }

    /**
     * Edit the Contact resource in storage.
     *
     * @route GET /resource/crm/contacts/edit/{contact} playground.crm.resource.contacts.edit
     */
    public function edit(
        Contact $contact,
        Requests\Contact\EditRequest $request
    ): JsonResponse|View|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $flash = $contact->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $contact->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $contact,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        session()->flashInput($flash);

        return view(sprintf('%1$s/form', $this->packageInfo['view']), $data);
    }

    /**
     * Remove the Contact resource from storage.
     *
     * @route DELETE /resource/crm/contacts/{contact} playground.crm.resource.contacts.destroy
     */
    public function destroy(
        Contact $contact,
        Requests\Contact\DestroyRequest $request
    ): Response|RedirectResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $contact->delete();
        } else {
            $contact->forceDelete();
        }

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route($this->packageInfo['model_route']));
    }

    /**
     * Lock the Contact resource in storage.
     *
     * @route PUT /resource/crm/contacts/{contact} playground.crm.resource.contacts.lock
     */
    public function lock(
        Contact $contact,
        Requests\Contact\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->locked = true;

        $contact->save();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $contact->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $this->packageInfo['model_route']
        ), ['contact' => $contact->id]));
    }

    /**
     * Display a listing of Contact resources.
     *
     * @route GET /resource/crm/contacts playground.crm.resource.contacts
     */
    public function index(
        Requests\Contact\IndexRequest $request
    ): JsonResponse|View|Resources\ContactCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Contact::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

        $query->sort($validated['sort'] ?? null);

        if (! empty($validated['filter']) && is_array($validated['filter'])) {

            $query->filterTrash($validated['filter']['trash'] ?? null);

            $query->filterIds(
                $request->getPaginationIds(),
                $validated
            );

            $query->filterFlags(
                $request->getPaginationFlags(),
                $validated
            );

            $query->filterDates(
                $request->getPaginationDates(),
                $validated
            );

            $query->filterColumns(
                $request->getPaginationColumns(),
                $validated
            );
        }

        $perPage = ! empty($validated['perPage']) && is_int($validated['perPage']) ? $validated['perPage'] : null;
        $paginator = $query->paginate($perPage);

        $paginator->appends($validated);

        if ($request->expectsJson()) {
            return (new Resources\ContactCollection($paginator))->response($request);
        }

        $meta = [
            'session_user_id' => $user?->id,
            'columns' => $request->getPaginationColumns(),
            'dates' => $request->getPaginationDates(),
            'flags' => $request->getPaginationFlags(),
            'ids' => $request->getPaginationIds(),
            'rules' => $request->rules(),
            'sortable' => $request->getSortable(),
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $data = [
            'paginator' => $paginator,
            'meta' => $meta,
        ];

        return view(sprintf('%1$s/index', $this->packageInfo['view']), $data);
    }

    /**
     * Restore the Contact resource from the trash.
     *
     * @route PUT /resource/crm/contacts/restore/{contact} playground.crm.resource.contacts.restore
     */
    public function restore(
        Contact $contact,
        Requests\Contact\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->restore();

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $this->packageInfo['model_route']
        ), ['contact' => $contact->id]));
    }

    /**
     * Display the Contact resource.
     *
     * @route GET /resource/crm/contacts/{contact} playground.crm.resource.contacts.show
     */
    public function show(
        Contact $contact,
        Requests\Contact\ShowRequest $request
    ): JsonResponse|View|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $contact->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $contact,
            'meta' => $meta,
        ];

        return view(sprintf('%1$s/detail', $this->packageInfo['view']), $data);
    }

    /**
     * Store a newly created API Contact resource in storage.
     *
     * @route POST /resource/crm/contacts playground.crm.resource.contacts.post
     */
    public function store(
        Requests\Contact\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact = new Contact($validated);

        if ($user?->id) {
            $contact->created_by_id = $user->id;
        }

        $contact->save();

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $this->packageInfo['model_route']
        ), ['contact' => $contact->id]));
    }

    /**
     * Unlock the Contact resource in storage.
     *
     * @route DELETE /resource/crm/contacts/lock/{contact} playground.crm.resource.contacts.unlock
     */
    public function unlock(
        Contact $contact,
        Requests\Contact\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact->locked = false;

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->save();

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $this->packageInfo['model_route']
        ), ['contact' => $contact->id]));
    }

    /**
     * Update the Contact resource in storage.
     *
     * @route PATCH /resource/crm/contacts/{contact} playground.crm.resource.contacts.patch
     */
    public function update(
        Contact $contact,
        Requests\Contact\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact->update($validated);

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        if ($request->expectsJson()) {
            return (new Resources\Contact($contact))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $this->packageInfo['model_route']
        ), ['contact' => $contact->id]));
    }
}
