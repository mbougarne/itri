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
        return Post::create($data);
    }

    public function update($post, array $data)
    {
        return $post->update($data);
    }

    public function delete($post)
    {
        return $post->delete();
    }
}
