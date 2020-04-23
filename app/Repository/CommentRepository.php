<?php

namespace App\Repository;

use App\Repository\Contracts\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Get all Comments
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Comment::all();
    }

    /**
     * Get latest Comments based on their published status
     *
     * @param int $status
     * @param int $limit number of Comments by default 5
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLatest(int $status, int $limit = 5)
    {
        return Comment::published($status)->latest()->limit($limit)->get();
    }

    /**
     * Get all Comments where is_published is 1 by default
     *
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allByStatus(int $status = 1)
    {
        return Comment::published($status)->get();
    }

    /**
     * Get chunck of Comments
     *
     * @param integer $limit number of Comments
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $limit = 15)
    {
        return Comment::paginate($limit);
    }

    /**
     * Create new Comment
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        $comment = Comment::create($data);
        return $comment;
    }

    /**
     * Update an existing Comment
     *
     * @param \App\Models\Comment $comment
     * @param array $data Comment data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Comment $comment, array $data)
    {
        $updatedComment = $comment->update($data);
        return $updatedComment;
    }

    /**
     * Delete a Comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    /**
     * Get children of comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function children(Comment $comment)
    {
        return $comment->children();
    }

    /**
     * Get parent of comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function parent(Comment $comment)
    {
        return $comment->parent();
    }
}
