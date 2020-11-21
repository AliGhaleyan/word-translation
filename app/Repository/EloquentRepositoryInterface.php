<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function paginate($perPage = 25);

    public function find($id): ?Model;

    public function create(array $data): ?Model;

    public function update(Model $model, array $data): bool;

    public function delete(Model $model): bool;
}
