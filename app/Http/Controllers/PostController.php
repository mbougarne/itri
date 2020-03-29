<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repository\Contracts\CrudRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected Request $request;
    protected CrudRepositoryInterface $repository;

    public function __construct(Request $request, CrudRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $data = $this->validateRequest();
        if(!$this->request->has('seo')){}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    protected function validateRequest()
    {
        return $this->request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
            'slug' => 'sometimes|nullable|unique:posts',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000'
        ]);
    }
}
