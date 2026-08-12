<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Services\MenuItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MenuItemController extends Controller
{
    protected MenuItemService $service;

    public function __construct(MenuItemService $service)
    {
        $this->service = $service;
    }

    public function index(): AnonymousResourceCollection
    {
        return MenuItemResource::collection($this->service->getAllMenuItems());
    }

    public function show(int $id): JsonResponse|MenuItemResource
    {
        $item = $this->service->getMenuItemById($id);
        if (!$item) {
            return response()->json(['message' => 'Elemento del menú no encontrado'], 404);
        }
        return new MenuItemResource($item);
    }

    public function store(StoreMenuItemRequest $request): JsonResponse
    {
        $item = $this->service->createMenuItem($request->validated());
        return (new MenuItemResource($item))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateMenuItemRequest $request, int $id): JsonResponse
    {
        $updated = $this->service->updateMenuItem($id, $request->validated());
        if (!$updated) {
            return response()->json(['message' => 'No se pudo actualizar o el elemento no existe'], 404);
        }
        $item = $this->service->getMenuItemById($id);
        return (new MenuItemResource($item))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->deleteMenuItem($id);
        if (!$deleted) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }
        return response()->json(['message' => 'Elemento del menú eliminado correctamente']);
    }

    public function getByCategory(string $category): AnonymousResourceCollection
    {
        return MenuItemResource::collection($this->service->getMenuItemsByCategory($category));
    }
}
