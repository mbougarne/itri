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
     * Get single category based on its slug
     *
     * @param string $key slug by default
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key)
    {
        return Category::firstWhere('slug', $key);
    }

     /**
     * Create new category
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        return Category::create($data);
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
