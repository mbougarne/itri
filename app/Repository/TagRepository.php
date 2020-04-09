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
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key = 'slug', $value)
    {
        return Tag::firstWhere($key, $value);
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
     * Create new tag
     *
     * @param array $tags
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function saveFromPost(array $tags)
    {
        if(!is_array($tags)) return false;

        $created_tags_ids = [];
        foreach($tags as $tag)
        {
            $createdTag = Tag::firstOrCreate(['name' => $tag]);
            $created_tags_ids[] = $createdTag->id;
        }

        return $created_tags_ids;
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
