<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\PostRepositoryInterface as PostRepository;

class DashboardController
{

    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view(
            'dashboard.template',
            [
                'title' => 'dashboard',
                'posts' => $this->repository->getLatest(1)
            ]
        );
    }

    public function credits()
    {
        return view('dashboard.credits', ['title' => 'credits']);
    }
}
