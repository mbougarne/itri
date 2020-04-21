<?php

namespace App\Repository\Contracts;

use App\Models\Page;

interface PageRepositoryInterface
{
    /**
     * Get all Pages
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get all Pages using custom queries
     * We have by default all Pages sorted by created_at in descending way
     * For that we use this method in contrary to what we have by default
     *
     * @param integer $status published by default
     * @param string $order_by updated_at by default
     * @param string $order in ASC  by default
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWhere(int $status = 1, string $order_by = 'updated_at', string $order = 'ASC');

    /**
     * Get all Pages where is_published is 1 by default
     *
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allByStatus(int $status = 1);

    /**
     * Get single Page based on key -> value
     *
     * @param mixed $value
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single($value, string $key = 'slug');

    /**
     * Create new Page
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing Page
     *
     * @param \App\Models\Page $page
     * @param array $data Page data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Page $page, array $data);

    /**
     * Delete a Page
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Page $page);
}
