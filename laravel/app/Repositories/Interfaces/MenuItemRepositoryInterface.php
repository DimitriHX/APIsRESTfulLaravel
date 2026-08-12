<?php

namespace App\Repositories\Interfaces;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

interface MenuItemRepositoryInterface
{
    public function all(): Collection;
    public function findById(int $id): ?MenuItem;
    public function create(array $data): MenuItem;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getByCategory(string $category): Collection;
}
