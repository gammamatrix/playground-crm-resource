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
use Playground\Crm\Models\People;
use Playground\Crm\Resource\Http\Requests;
use Playground\Crm\Resource\Http\Resources;

/**
 * \Playground\Crm\Resource\Http\Controllers\PeopleController
 */
class PeopleController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'People',
        'model_label_plural' => 'People',
        'model_route' => 'playground.crm.resource.people',
        'model_slug' => 'people',
        'model_slug_plural' => 'people',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:people',
        'table' => 'crm_people',
        'view' => 'playground-crm-resource::people',
    ];

    /**
     * Create the People resource in storage.
     *
     * @route GET /resource/crm/people/create playground.crm.resource.people.create
     */
    public function create(
        Requests\People\CreateRequest $request
    ): JsonResponse|View|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $people = new People($validated);

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $people,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $people->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        if (! $request->session()->has('errors')) {
            session()->flashInput($flash);
        }

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Edit the People resource in storage.
     *
     * @route GET /resource/crm/people/edit/{people} playground.crm.resource.people.edit
     */
    public function edit(
        People $people,
        Requests\People\EditRequest $request
    ): JsonResponse|View|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $flash = $people->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $people->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $people,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        if (! empty($validated['_return_url'])) {
            $data['_return_url'] = $validated['_return_url'];
        }

        session()->flashInput($flash);

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Remove the People resource from storage.
     *
     * @route DELETE /resource/crm/people/{people} playground.crm.resource.people.destroy
     */
    public function destroy(
        People $people,
        Requests\People\DestroyRequest $request
    ): Response|RedirectResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $people->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $people->delete();
        } else {
            $people->forceDelete();
        }

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route($packageInfo->model_route()));
    }

    /**
     * Lock the People resource in storage.
     *
     * @route PUT /resource/crm/people/{people} playground.crm.resource.people.lock
     */
    public function lock(
        People $people,
        Requests\People\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $people->modified_by_id = $user->id;
        }

        $people->locked = true;

        $people->save();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['people' => $people->id]));
    }

    /**
     * Display a listing of People resources.
     *
     * @route GET /resource/crm/people playground.crm.resource.people
     */
    public function index(
        Requests\People\IndexRequest $request
    ): JsonResponse|View|Resources\PeopleCollection {

        $packageInfo = $this->packageInfo();

        /**
         * @var array{
         *     sort: string|array<mixed>,
         *     filter: array{
         *         trash: string
         *     },
         *     perPage: int
         * } $validated
         */
        $validated = $request->validated();

        $query = People::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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
            return new Resources\PeopleCollection($paginator)->response($request);
        }

        $user = $request->user();

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
            'info' => $packageInfo,
        ];

        $data = [
            'paginator' => $paginator,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/index', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Restore the People resource from the trash.
     *
     * @route PUT /resource/crm/people/restore/{people} playground.crm.resource.people.restore
     */
    public function restore(
        People $people,
        Requests\People\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people->modified_by_id = $user?->id;

        $people->restore();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['people' => $people->id]));
    }

    /**
     * Display the People resource.
     *
     * @route GET /resource/crm/people/{people} playground.crm.resource.people.show
     */
    public function show(
        People $people,
        Requests\People\ShowRequest $request
    ): JsonResponse|View|Resources\People {

        $packageInfo = $this->packageInfo();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $people->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $people,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/detail', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Store a newly created API People resource in storage.
     *
     * @route POST /resource/crm/people playground.crm.resource.people.post
     */
    public function store(
        Requests\People\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people = new People($validated);

        $people->created_by_id = $user?->id;

        $people->save();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request)->setStatusCode(201);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['people' => $people->id]));
    }

    /**
     * Unlock the People resource in storage.
     *
     * @route DELETE /resource/crm/people/lock/{people} playground.crm.resource.people.unlock
     */
    public function unlock(
        People $people,
        Requests\People\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people->locked = false;

        $people->modified_by_id = $user?->id;

        $people->save();

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['people' => $people->id]));
    }

    /**
     * Update the People resource in storage.
     *
     * @route PATCH /resource/crm/people/{people} playground.crm.resource.people.patch
     */
    public function update(
        People $people,
        Requests\People\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people->modified_by_id = $user?->id;

        $people->update($validated);

        if ($request->expectsJson()) {
            return new Resources\People($people)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['people' => $people->id]));
    }
}
