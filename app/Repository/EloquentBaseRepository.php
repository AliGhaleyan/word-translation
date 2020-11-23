<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

class EloquentBaseRepository implements EloquentRepositoryInterface
{
    /** @var Model $model */
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function paginate($perPage = 25)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): ?Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
