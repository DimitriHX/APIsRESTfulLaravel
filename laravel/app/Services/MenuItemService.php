<?php

namespace App\Services;

use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuItemService
{
    protected MenuItemRepositoryInterface $repository;

    public function __construct(MenuItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllMenuItems(): Collection
    {
        return $this->repository->all();
    }

    public function getMenuItemById(int $id): ?MenuItem
    {
        return $this->repository->findById($id);
    }

    public function createMenuItem(array $data): MenuItem
    {
        // Business logic check: default availability if omitted
        if (!isset($data['is_available'])) {
            $data['is_available'] = true;
        }
        return $this->repository->create($data);
    }

    public function updateMenuItem(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function deleteMenuItem(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getMenuItemsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }
}
