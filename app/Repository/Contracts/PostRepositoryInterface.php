<?php

namespace App\Repository\Contracts;

use App\Models\Post;

interface PostRepositoryInterface
{
    /**
     * Get all posts
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get latest posts based on their published status
     *
     * @param int $status
     * @param int $limit number of posts by default 10
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLatest(int $status, int $limit = 10);

    /**
     * Get all posts using custom queries
     * We have by default all posts sorted by created_at in descending way
     * For that we use this method in contrary to what we have by default
     *
     * @param integer $status published by default
     * @param string $order_by updated_at by default
     * @param string $order in ASC  by default
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWhere(int $status = 1, string $order_by = 'updated_at', string $order = 'ASC');

    /**
     * Get all posts where is_published is 1 by default
     *
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allByStatus(int $status = 1);

    /**
     * Get chunck of posts
     *
     * @param integer $limit number of posts
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $limit = 15);

    /**
     * Get single post based on key -> value
     *
     * @param mixed $value
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single($value, string $key = 'slug');

    /**
     * Create new post
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing post
     *
     * @param \App\Models\Post $post
     * @param array $data post data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Post $post, array $data);

    /**
     * Delete a post
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Post $post);

    /**
     * Get all categories
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categories(Post $post);

    /**
     * Get all tags
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function tags(Post $post);
}
