<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface EloquentRepositoryInterface
 *
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * Creates a new record in the database.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Delete a record in database.
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * Updates a record in database.
     *
     * @param $id
     * @param $attributes
     * @return bool
     */
    public function update($id, $attributes): bool;

    /**
     * Find a record in database by it's id.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id): ?Model;

    /**
     * Indicates paginated data.
     *
     * @param int $length
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $length = 15): LengthAwarePaginator;
}
