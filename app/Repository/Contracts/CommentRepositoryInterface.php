<?php

namespace App\Repository\Contracts;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    /**
     * Get all comments
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get latest comments based on their published status
     *
     * @param int $status
     * @param int $limit number of comments by default 5
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLatest(int $status, int $limit = 5);

    /**
     * Get all comments where is_published is 1 by default
     *
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allByStatus(int $status = 1);

    /**
     * Get chunck of comments
     *
     * @param integer $limit number of comments
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $limit = 30);

    /**
     * Create new comment
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing comment
     *
     * @param \App\Models\Comment $comment
     * @param array $data comment data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Comment $comment, array $data);

    /**
     * Delete a comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Comment $comment);

    /**
     * Get children of comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function children(Comment $comment);

    /**
     * Get parent of comment
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function parent(Comment $comment);

}
