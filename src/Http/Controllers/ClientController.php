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
use Playground\Crm\Models\Client;
use Playground\Crm\Resource\Http\Requests;
use Playground\Crm\Resource\Http\Resources;

/**
 * \Playground\Crm\Resource\Http\Controllers\ClientController
 */
class ClientController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Client',
        'model_label_plural' => 'Clients',
        'model_route' => 'playground.crm.resource.clients',
        'model_slug' => 'client',
        'model_slug_plural' => 'clients',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:client',
        'table' => 'crm_clients',
        'view' => 'playground-crm-resource::client',
    ];

    /**
     * Create the Client resource in storage.
     *
     * @route GET /resource/crm/clients/create playground.crm.resource.clients.create
     */
    public function create(
        Requests\Client\CreateRequest $request
    ): JsonResponse|View|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $client = new Client($validated);

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $client,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $client->toArray();

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
     * Edit the Client resource in storage.
     *
     * @route GET /resource/crm/clients/edit/{client} playground.crm.resource.clients.edit
     */
    public function edit(
        Client $client,
        Requests\Client\EditRequest $request
    ): JsonResponse|View|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $flash = $client->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $client->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $client,
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
     * Remove the Client resource from storage.
     *
     * @route DELETE /resource/crm/clients/{client} playground.crm.resource.clients.destroy
     */
    public function destroy(
        Client $client,
        Requests\Client\DestroyRequest $request
    ): Response|RedirectResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $client->delete();
        } else {
            $client->forceDelete();
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
     * Lock the Client resource in storage.
     *
     * @route PUT /resource/crm/clients/{client} playground.crm.resource.clients.lock
     */
    public function lock(
        Client $client,
        Requests\Client\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->locked = true;

        $client->save();

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
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
        ), ['client' => $client->id]));
    }

    /**
     * Display a listing of Client resources.
     *
     * @route GET /resource/crm/clients playground.crm.resource.clients
     */
    public function index(
        Requests\Client\IndexRequest $request
    ): JsonResponse|View|Resources\ClientCollection {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

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

        $query = Client::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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
            return new Resources\ClientCollection($paginator)->response($request);
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
     * Restore the Client resource from the trash.
     *
     * @route PUT /resource/crm/clients/restore/{client} playground.crm.resource.clients.restore
     */
    public function restore(
        Client $client,
        Requests\Client\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->restore();

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
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
        ), ['client' => $client->id]));
    }

    /**
     * Display the Client resource.
     *
     * @route GET /resource/crm/clients/{client} playground.crm.resource.clients.show
     */
    public function show(
        Client $client,
        Requests\Client\ShowRequest $request
    ): JsonResponse|View|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $client->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $data = [
            'data' => $client,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/detail', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Store a newly created API Client resource in storage.
     *
     * @route POST /resource/crm/clients playground.crm.resource.clients.post
     */
    public function store(
        Requests\Client\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $client = new Client($validated);

        if ($user?->id) {
            $client->created_by_id = $user->id;
        }

        $client->save();

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
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
        ), ['client' => $client->id]));
    }

    /**
     * Unlock the Client resource in storage.
     *
     * @route DELETE /resource/crm/clients/lock/{client} playground.crm.resource.clients.unlock
     */
    public function unlock(
        Client $client,
        Requests\Client\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $client->locked = false;

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->save();

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
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
        ), ['client' => $client->id]));
    }

    /**
     * Update the Client resource in storage.
     *
     * @route PATCH /resource/crm/clients/{client} playground.crm.resource.clients.patch
     */
    public function update(
        Client $client,
        Requests\Client\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\Client {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->update($validated);

        if ($request->expectsJson()) {
            return new Resources\Client($client)->additional(['meta' => [
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
        ), ['client' => $client->id]));
    }
}
