<?php

namespace App\Repository;

use App\Repository\Contracts\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    /**
     * Get all pages
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Page::all();
    }

    /**
     * Get all pages using custom queries
     * We have by default all pages sorted by created_at in descending way
     * For that we use this method in contrary to what we have by default
     *
     * @param integer $status published by default
     * @param string $order_by updated_at by default
     * @param string $order in ASC  by default
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWhere(int $status = 1, string $order_by = 'updated_at', string $order = 'ASC')
    {
        return Page::published($status)->orderBy($order_by, $order)->get();
    }

    /**
     * Get all pages where is_published is 1 by default
     *
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allByStatus(int $status = 1)
    {
        return Page::published($status)->get();
    }

    /**
     * Get single page based on key -> value
     *
     * @param string $key slug by default
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single($value, string $key = 'slug')
    {
        return Page::firstWhere($key, $value);
    }

     /**
     * Create new page
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        return Page::create($data);
    }

    /**
     * Update an existing page
     *
     * @param \App\Models\Page $page
     * @param array $data page data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Page $page, array $data)
    {
        return $page->update($data);
    }

    /**
     * Delete a page
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Page $page)
    {
        return $page->delete();
    }
}
