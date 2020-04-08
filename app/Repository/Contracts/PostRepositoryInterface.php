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
     * Get chunck of posts
     *
     * @param integer $limit number of posts
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $limit = 15);

    /**
     * Get single post based on key -> value
     *
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key = 'slug', $value);

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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categories();

    /**
     * Get all tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function tags();
}
