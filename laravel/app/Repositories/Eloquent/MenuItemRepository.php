<?php

namespace App\Repositories\Eloquent;

use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    public function all(): Collection
    {
        return MenuItem::orderBy('id', 'desc')->get();
    }

    public function findById(int $id): ?MenuItem
    {
        return MenuItem::find($id);
    }

    public function create(array $data): MenuItem
    {
        return MenuItem::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $item = $this->findById($id);
        if (!$item) {
            return false;
        }
        return $item->update($data);
    }

    public function delete(int $id): bool
    {
        $item = $this->findById($id);
        if (!$item) {
            return false;
        }
        return (bool) $item->delete();
    }

    public function getByCategory(string $category): Collection
    {
        return MenuItem::whereRaw('LOWER(category) = ?', [strtolower($category)])
            ->orderBy('id', 'desc')
            ->get();
    }
}
