<?php

namespace App\Interfaces;

/**
 * Interface RepositoryInterface
 *
 * @package App\Interfaces
 */
interface RepositoryInterface
{
    /**
     * Get all the resources from the storage
     *
     * @param  array $columns The column u needed in the output.
     * @return mixed
     */
    public function getAll(array $columns = ['*']);

    /**
     * Get a specific resource from the storage.
     *
     * @param  mixed $id The unique identifier from the resource
     * @return mixed
     */
    public function find($id);

    /**
     * Create a resource in the storage
     *
     * @param array $attributes The attributes for the resource.
     */
    public function create(array $attributes);

    /**
     * Update a resource in the storage
     *
     * @param  mixed $id
     * @param  array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);
}