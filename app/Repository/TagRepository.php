<?php

namespace App\Repository;

use App\Repository\Contracts\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    /**
     * Get all tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Tag::all();
    }

    /**
     * Get single tags based on its slug
     *
     * @param string $key slug by default
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key)
    {
        return Tag::firstWhere('slug', $key);
    }

     /**
     * Create new tag
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        return Tag::create($data);
    }

    /**
     * Update an existing tag
     *
     * @param \App\Models\Tag $tag
     * @param array $data tag data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Tag $tag, array $data)
    {
        return $tag->update($data);
    }

    /**
     * Delete a tag
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Tag $tag)
    {
        return $tag->delete();
    }

    /**
     * Get tag posts
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts(Tag $tag)
    {
        return $tag->posts();
    }
}
