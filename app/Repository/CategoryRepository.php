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
     * @param \App\Models\category $category
     * @param array $data category data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update($category, array $data)
    {
        return $category->update($data);
    }

    /**
     * Delete a category
     *
     * @param \App\Models\category $category
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete($category)
    {
        return $category->delete();
    }

    /**
     * Get category posts
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts(Category $category)
    {
        return $category->posts();
    }

    /**
     * Get category children
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function children(Category $category)
    {
        return $category->children();
    }

    /**
     * Get category parent
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function parent(Category $category)
    {
        return $category->parent();
    }
}
