<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Contracts\CrudRepositoryInterface;
use App\Models\{OpenGraph, Post, SEO};

class PostController extends Controller
{
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
        $posts = $this->repository->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000'
        ]);

        $seo = SEO::create([
            'title' => $request->seo_title ?? $request->title,
            'description' => $request->seo_desc ?? $request->description,
            'slug' => $request->slug ?? $request->title,
            'focus_keyword' => $request->focusKeyword
        ]);

        $opg = OpenGraph

        $data = array_merge(
            $request->all(),
            [
                'seo_id' => $seo->id,
                'open_graph_id' => $opg->id,
            ]
        );

        $postCreated = $this->repository->save($data);
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

}
