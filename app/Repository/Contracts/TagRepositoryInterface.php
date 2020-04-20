<?php

namespace App\Repository\Contracts;

use App\Models\Tag;

interface TagRepositoryInterface
{
    /**
     * Get all tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|Static[]
     */
    public function all();

    /**
     * Get single Tag based on its slug
     *
     * @param mixed $value
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single($value, string $key = 'slug');

    /**
     * Create new tag
     *
     * @param array $tags
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function saveFromPost(array $tags);

    /**
     * Update an existing Tag
     *
     * @param \App\Models\Tag $tag
     * @param array $data Tag data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Tag $tag, array $data);

    /**
     * Delete a Tag
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Tag $tag);

    /**
     * Get Tag posts
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts(Tag $tag);
}
