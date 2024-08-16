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
use Playground\Crm\Models\Organization;
use Playground\Crm\Resource\Http\Requests;
use Playground\Crm\Resource\Http\Resources;

/**
 * \Playground\Crm\Resource\Http\Controllers\OrganizationController
 */
class OrganizationController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Organization',
        'model_label_plural' => 'Organizations',
        'model_route' => 'playground.crm.resource.organizations',
        'model_slug' => 'organization',
        'model_slug_plural' => 'organizations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:organization',
        'table' => 'crm_organizations',
        'view' => 'playground-crm-resource::organization',
    ];

    /**
     * Create the Organization resource in storage.
     *
     * @route GET /resource/crm/organizations/create playground.crm.resource.organizations.create
     */
    public function create(
        Requests\Organization\CreateRequest $request
    ): JsonResponse|View|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization = new Organization($validated);

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
            'data' => $organization,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $organization->toArray();

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
     * Edit the Organization resource in storage.
     *
     * @route GET /resource/crm/organizations/edit/{organization} playground.crm.resource.organizations.edit
     */
    public function edit(
        Organization $organization,
        Requests\Organization\EditRequest $request
    ): JsonResponse|View|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $flash = $organization->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $organization->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $organization,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        session()->flashInput($flash);

        return view(sprintf('%1$s/form', $this->packageInfo['view']), $data);
    }

    /**
     * Remove the Organization resource from storage.
     *
     * @route DELETE /resource/crm/organizations/{organization} playground.crm.resource.organizations.destroy
     */
    public function destroy(
        Organization $organization,
        Requests\Organization\DestroyRequest $request
    ): Response|RedirectResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $organization->delete();
        } else {
            $organization->forceDelete();
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
     * Lock the Organization resource in storage.
     *
     * @route PUT /resource/crm/organizations/{organization} playground.crm.resource.organizations.lock
     */
    public function lock(
        Organization $organization,
        Requests\Organization\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->locked = true;

        $organization->save();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $organization->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
        ), ['organization' => $organization->id]));
    }

    /**
     * Display a listing of Organization resources.
     *
     * @route GET /resource/crm/organizations playground.crm.resource.organizations
     */
    public function index(
        Requests\Organization\IndexRequest $request
    ): JsonResponse|View|Resources\OrganizationCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Organization::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

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
            return (new Resources\OrganizationCollection($paginator))->response($request);
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
     * Restore the Organization resource from the trash.
     *
     * @route PUT /resource/crm/organizations/restore/{organization} playground.crm.resource.organizations.restore
     */
    public function restore(
        Organization $organization,
        Requests\Organization\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->restore();

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
        ), ['organization' => $organization->id]));
    }

    /**
     * Display the Organization resource.
     *
     * @route GET /resource/crm/organizations/{organization} playground.crm.resource.organizations.show
     */
    public function show(
        Organization $organization,
        Requests\Organization\ShowRequest $request
    ): JsonResponse|View|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $organization->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
                'info' => $this->packageInfo,
            ]])->response($request);
        }

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $organization,
            'meta' => $meta,
        ];

        return view(sprintf('%1$s/detail', $this->packageInfo['view']), $data);
    }

    /**
     * Store a newly created API Organization resource in storage.
     *
     * @route POST /resource/crm/organizations playground.crm.resource.organizations.post
     */
    public function store(
        Requests\Organization\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization = new Organization($validated);

        if ($user?->id) {
            $organization->created_by_id = $user->id;
        }

        $organization->save();

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
        ), ['organization' => $organization->id]));
    }

    /**
     * Unlock the Organization resource in storage.
     *
     * @route DELETE /resource/crm/organizations/lock/{organization} playground.crm.resource.organizations.unlock
     */
    public function unlock(
        Organization $organization,
        Requests\Organization\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization->locked = false;

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->save();

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
        ), ['organization' => $organization->id]));
    }

    /**
     * Update the Organization resource in storage.
     *
     * @route PATCH /resource/crm/organizations/{organization} playground.crm.resource.organizations.patch
     */
    public function update(
        Organization $organization,
        Requests\Organization\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization->update($validated);

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        if ($request->expectsJson()) {
            return (new Resources\Organization($organization))->additional(['meta' => [
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
        ), ['organization' => $organization->id]));
    }
}
