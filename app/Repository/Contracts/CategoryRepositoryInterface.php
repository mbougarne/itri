<?php

namespace App\Repository\Contracts;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     * Get all Categorys
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get categories with customer WHERE query
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWhere(string $column, string $operator, $value);

    /**
     * Get single Category based on its slug
     *
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key = 'slug', $value);

    /**
     * Create new Category
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing Category
     *
     * @param \App\Models\Category $category
     * @param array $data Category data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Category $category, array $data);

    /**
     * Delete a Category
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Category $category);

    /**
     * Fet category posts
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts(Category $category);

    /**
     * Get category children
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function children(Category $category);

    /**
     * Get category parent
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function parent(Category $category);
}
