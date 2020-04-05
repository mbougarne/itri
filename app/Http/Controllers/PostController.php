<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repository\Contracts\CrudRepositoryInterface;
use App\Models\Post;

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
        $title = "Posts";
        $description = "Manage your posts";
        $links = [
            'posts' => 'All',
            'posts.published' => 'Published',
            'posts.pending' => 'Pending'
        ];

        return view('dashboard.posts.index', [
            'posts' => $this->repository->getAll(),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Post";
        $description = "Use the form below to create new post";

        return view('dashboard.posts.create', [
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validateRequest();

        if(!$this->request->has('slug'))
        {
            $data = array_merge($data, ['slug' => $this->request->title]);
        }

        $createdPost = $this->repository->save($data);

        if($this->request->hasFile('thumbnail'))
        {
            $ext = $this->request->file('thumbnail')->extension();
            $thumbnail = Str::slug($this->request->file('thumbnail')) . '-' . time() . '.' . $ext;
            $this->request->file('thumbnail')->storeAs('thumbnails/', $thumbnail, 'uploads');
        }

        if($createdPost)
            return response('created post', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('templates.default.posts.single', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('templates.default.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $data = array_merge($this->validateRequest(), ['slug' => $this->request->title]);

        $updatedPost = $this->repository->update($post, $data);

        if($this->request->hasFile('thumbnail'))
        {
            $ext = $this->request->file('thumbnail')->extension();
            $thumbnail = Str::slug($this->request->file('thumbnail')) . '-' . time() . '.' . $ext;
            $this->request->file('thumbnail')->storeAs('thumbnails/', $thumbnail, 'uploads');
        }

        return response('created post', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deleted = $this->repository->delete($post);

        if($deleted) {
            return response('post deleted', 200);
        }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload_image'))
        {
            $ext = $request->file('upload_image')->extension();
            $image = Str::random() . '-' . time() . '.' . $ext;
            $request->file('upload_image')->storeAs('thumbnails/', $image, 'uploads');
            return response()->json([
                'success' => true,
                'msg' => 'Image has been saved',
                'image' => $image,
                'path' => asset('uploads/thumbnails/' . $image)
            ]);
        }

        return response()->json(['error' => 'There is an issue']);
    }

    protected function validateRequest()
    {
        return $this->request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
            'slug' => 'sometimes|nullable|unique:posts',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
            'is_published' => 'sometimes|boolean',
            'categories' => 'sometimes|exists:categories,id',
            'tags' => 'sometimes|exists:categories,id'
        ]);
    }
}
