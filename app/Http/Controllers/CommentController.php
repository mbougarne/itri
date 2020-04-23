<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Repository\Contracts\CommentRepositoryInterface;
use App\Http\Controllers\Lib\ControllerMethod;

class CommentController extends Controller
{
    /**
     * Upcoming request
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Comment Repository Interface
     *
     * @var \App\Repository\Contracts\CommentRepositoryInterface
     */
    protected $repository;

    /**
     * Controller Method
     *
     * @var \App\Http\Controllers\Lib\ControllerMethod
     */
    protected $controllerMethod;

    /**
     * Dependency injection for Request, CommentRepository and ControllerMethod
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\CategoryRepositoryInterface $repository
     * @param \App\Repository\Contracts\CommentRepositoryInterface $method
     *
     * @return void
     */
    public function __construct(
        Request $request,
        CategoryRepositoryInterface $repository,
        ControllerMethod $method)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->controllerMethod = $method;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    /**
     * Rules of request validation
     *
     * @return array
     */
    protected function requestValidationRules()
    {
        return [
            'post_id' => 'required|exists:postst,id',
            'parent_id' => 'sometimes|nullable',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'body' => 'required|string',
            'is_subscribed' => 'required'
        ];
    }
}
