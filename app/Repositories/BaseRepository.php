<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The model to perform queries.
     *
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $length = 15): LengthAwarePaginator
    {
        return $this->model::paginate();
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return $this->model::where('id', $id)->forceDelete();
    }

    /**
     * @inheritDoc
     */
    public function update($id, $attributes): bool
    {
        return $this->model::where('id', $id)->forceDelete();
    }
}
