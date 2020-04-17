<?php

namespace App\Repository;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class categoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all categories
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * Get categories with customer WHERE query
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWhere(string $column, string $operator, $value)
    {
        return Category::where($column, $operator, $value)->get();
    }

    /**
     * Get single category based on its slug
     *
     * @param string $key slug by default
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key = 'slug', $value)
    {
        return Category::firstWhere($key, $value);
    }

     /**
     * Create new category
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        $category = (array_key_exists('parent_id', $data)) ? array_merge($data, ['is_sub' => 1]) : $data;
        return Category::create($category);
    }

    /**
     * Update an existing category
     *
     * @param \App\Models\Category $category
     * @param array $data category data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Category $category, array $data)
    {
        return $category->update($data);
    }

    /**
     * Delete a category
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }

    /**
     * Get category posts
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts(Category $category)
    {
        return $category->posts();
    }

    /**
     * Get category children
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function children(Category $category)
    {
        return $category->children();
    }

    /**
     * Get category parent
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function parent(Category $category)
    {
        return $category->parent();
    }
}
