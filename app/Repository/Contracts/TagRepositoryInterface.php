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
     * @param string $key
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single(string $key = 'slug', $value);

    /**
     * Create new Tag
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function posts();
}
