<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\PostRepositoryInterface as PostRepository;
use App\Repository\Contracts\CommentRepositoryInterface as CommentRepository;

class DashboardController
{
    /**
     * Post repository
     *
     * @var \App\Repository\Contracts\PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * Comment repository
     *
     * @var \App\Repository\Contracts\CommentRepositoryInterface
     */
    protected $commentRepository;

    public function __construct(
        PostRepository $postRepository,
        CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return view(
            'dashboard.template',
            [
                'title' => 'dashboard',
                'posts' => $this->postRepository->getLatest(1),
                'comments' => $this->commentRepository->getLatest(0),
            ]
        );
    }

    public function credits()
    {
        return view('dashboard.credits', ['title' => 'credits']);
    }
}
