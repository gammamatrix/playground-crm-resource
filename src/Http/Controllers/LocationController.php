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
use Playground\Crm\Models\Location;
use Playground\Crm\Resource\Http\Requests;
use Playground\Crm\Resource\Http\Resources;

/**
 * \Playground\Crm\Resource\Http\Controllers\LocationController
 */
class LocationController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Location',
        'model_label_plural' => 'Locations',
        'model_route' => 'playground.crm.resource.locations',
        'model_slug' => 'location',
        'model_slug_plural' => 'locations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:location',
        'table' => 'crm_locations',
        'view' => 'playground-crm-resource::location',
    ];

    /**
     * Create the Location resource in storage.
     *
     * @route GET /resource/crm/locations/create playground.crm.resource.locations.create
     */
    public function create(
        Requests\Location\CreateRequest $request
    ): JsonResponse|View|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $location = new Location($validated);

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
            'data' => $location,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $location->toArray();

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
     * Edit the Location resource in storage.
     *
     * @route GET /resource/crm/locations/edit/{location} playground.crm.resource.locations.edit
     */
    public function edit(
        Location $location,
        Requests\Location\EditRequest $request
    ): JsonResponse|View|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $flash = $location->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $location->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $location,
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
     * Remove the Location resource from storage.
     *
     * @route DELETE /resource/crm/locations/{location} playground.crm.resource.locations.destroy
     */
    public function destroy(
        Location $location,
        Requests\Location\DestroyRequest $request
    ): Response|RedirectResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $location->delete();
        } else {
            $location->forceDelete();
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
     * Lock the Location resource in storage.
     *
     * @route PUT /resource/crm/locations/{location} playground.crm.resource.locations.lock
     */
    public function lock(
        Location $location,
        Requests\Location\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        $location->locked = true;

        $location->save();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
        ), ['location' => $location->id]));
    }

    /**
     * Display a listing of Location resources.
     *
     * @route GET /resource/crm/locations playground.crm.resource.locations
     */
    public function index(
        Requests\Location\IndexRequest $request
    ): JsonResponse|View|Resources\LocationCollection {

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

        $query = Location::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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
            return new Resources\LocationCollection($paginator)->response($request);
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
     * Restore the Location resource from the trash.
     *
     * @route PUT /resource/crm/locations/restore/{location} playground.crm.resource.locations.restore
     */
    public function restore(
        Location $location,
        Requests\Location\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $location->modified_by_id = $user?->id;

        $location->restore();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
        ), ['location' => $location->id]));
    }

    /**
     * Display the Location resource.
     *
     * @route GET /resource/crm/locations/{location} playground.crm.resource.locations.show
     */
    public function show(
        Location $location,
        Requests\Location\ShowRequest $request
    ): JsonResponse|View|Resources\Location {

        $packageInfo = $this->packageInfo();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $location->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $location,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/detail', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Store a newly created API Location resource in storage.
     *
     * @route POST /resource/crm/locations playground.crm.resource.locations.post
     */
    public function store(
        Requests\Location\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $location = new Location($validated);

        $location->created_by_id = $user?->id;

        $location->save();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
        ), ['location' => $location->id]));
    }

    /**
     * Unlock the Location resource in storage.
     *
     * @route DELETE /resource/crm/locations/lock/{location} playground.crm.resource.locations.unlock
     */
    public function unlock(
        Location $location,
        Requests\Location\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $location->locked = false;

        $location->modified_by_id = $user?->id;

        $location->save();

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
        ), ['location' => $location->id]));
    }

    /**
     * Update the Location resource in storage.
     *
     * @route PATCH /resource/crm/locations/{location} playground.crm.resource.locations.patch
     */
    public function update(
        Location $location,
        Requests\Location\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\Location {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $location->modified_by_id = $user?->id;

        $location->update($validated);

        if ($request->expectsJson()) {
            return new Resources\Location($location)->additional(['meta' => [
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
        ), ['location' => $location->id]));
    }
}
