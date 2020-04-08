<?php

namespace App\Repository;

use App\Repository\Contracts\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Get all posts
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Post::all();
    }

    /**
     * Get chunck of posts
     *
     * @param integer $limit number of posts
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $limit = 15)
    {
        return Post::paginate($limit);
    }

    /**
     * Get single post based on its slug
     *
     * @param string $key slug by default
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key)
    {
        return Post::firstWhere('slug', $key);
    }

     /**
     * Create new post
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        $post = Post::create($data);

        if(in_array('categories', $data)) $post->categories->sync($data['categories']);

        if(in_array('tags', $data)) $post->tags->sync($data['tags']);

        return $post;
    }

    /**
     * Update an existing post
     *
     * @param \App\Models\Post $post
     * @param array $data post data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update($post, array $data)
    {
        $updatedPost = $post->update($data);

        if(in_array('categories', $data)) $post->categories->sync($data['categories']);

        if(in_array('tags', $data)) $post->tags->sync($data['tags']);

        return $updatedPost;
    }

    /**
     * Delete a post
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete($post)
    {
        return $post->delete();
    }

    /**
     * Get all categories
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categories(Post $post)
    {
        return $post->categories();
    }

    /**
     * Get all tags
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function tags(Post $post)
    {
        return $post->tags();
    }

    /**
     * Store tage
     *
     * @param array $tags
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function storeTags(array $tags){

    }
}
