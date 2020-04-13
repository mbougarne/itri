<?php

namespace App\Repository;

use App\Repository\Contracts\PostRepositoryInterface;
use App\Repository\Contracts\TagRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    protected $tagsRepository;

    public function __construct(TagRepositoryInterface $tagsRepository)
    {
        $this->tagsRepository = $tagsRepository;
    }

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
     * Get single post based on key -> value
     *
     * @param string $key slug by default
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single($value, string $key = 'slug')
    {
        return Post::firstWhere($key, $value);
    }

     /**
     * Create new post
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        $get_tags_from_data = $data['tags'] ?? null;
        $get_cats_from_data = $data['categories'] ?? null;

        unset($data['tags'], $data['categories']);

        $post = Post::create($data);

        if($get_tags_from_data) {

            $tags = explode(',', $get_tags_from_data);
            $tags_ids = $this->storeTags($tags);
            $post->tags()->sync($tags_ids);

        }

        if($get_cats_from_data) $post->categories()->sync($get_cats_from_data);

        return $post;
    }

    /**
     * Update an existing post
     *
     * @param \App\Models\Post $post
     * @param array $data post data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Post $post, array $data)
    {
        $get_tags_from_data = $data['tags'] ?? null;
        $get_cats_from_data = $data['categories'] ?? null;

        unset($data['tags'], $data['categories']);

        $updatedPost = $post->update($data);

        if($get_tags_from_data) {

            $tags = explode(',', $get_tags_from_data);
            $tags_ids = $this->storeTags($tags);
            $post->tags()->sync($tags_ids);

        }

        if($get_cats_from_data) $post->categories()->sync($get_cats_from_data);

        return $updatedPost;
    }

    /**
     * Delete a post
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Post $post)
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
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    protected function storeTags(array $tags){
        return $this->tagsRepository->saveFromPost($tags);
    }
}
