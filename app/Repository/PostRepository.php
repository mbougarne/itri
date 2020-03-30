<?php

namespace App\Repository;

use App\Models\Post;
use App\Repository\Contracts\CrudRepositoryInterface;

class PostRepository implements CrudRepositoryInterface
{
    public function getAll() : object
    {
        return Post::all();
    }

    public function paginate(int $limit = 15) : object
    {
        return Post::paginate($limit);
    }

    public function getItem() : object
    {
        return Post::first();
    }

    public function getItemByKey(string $key, $value) : object
    {
        return Post::where($key, $value)->first();
    }

    public function save(array $data)
    {
        $post = Post::create($data);

        if(in_array('categories', $data))
        {
            $post->categories->sync($data['categories']);
        }

        if(in_array('tags', $data))
        {
            $post->tags->sync($data['tags']);
        }

        return $post;
    }

    public function update($post, array $data)
    {
        $updatedPost = $post->update($data);

        if(in_array('categories', $data))
        {
            $post->categories->sync($data['categories']);
        }

        if(in_array('tags', $data))
        {
            $post->tags->sync($data['tags']);
        }

        return $updatedPost;
    }

    public function delete($post)
    {
        return $post->delete();
    }
}
