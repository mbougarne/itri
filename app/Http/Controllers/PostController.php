<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Repository\Contracts\PostRepositoryInterface;
use App\Repository\Contracts\CategoryRepositoryInterface;

class PostController extends Controller
{
    protected $repository;
    protected $categoryRepository;

    public function __construct(
        PostRepositoryInterface $repository,
        CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
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
            'posts' => $this->repository->all(),
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
        $categories = $this->categoryRepository->all();

        return view('dashboard.posts.create', [
            'title' => $title,
            'description' => $description,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
            'categories' => 'sometimes|nullable',
            'tags' => 'sometimes|nullable',
        ]);

        if($request->hasFile('thumbnail'))
        {
            $ext = $request->file('thumbnail')->extension();
            $thumbnail = Str::slug($request->file('thumbnail')) . '-' . time() . '.' . $ext;
            $data = array_merge($data, ['thumbnail' => $thumbnail]);

            $request->file('thumbnail')->storeAs('thumbnails/', $thumbnail, 'uploads');
        }

        $createdPost = $this->repository->save( $data );

        if($createdPost)
        {
            return redirect()->route('posts')->with('success', 'The post has created successfully!');
        }

        return redirect()->back()->withErrors(['errors' => 'There is an issue. Please try again!']);
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
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->title,
        ];

        if($request->hasFile('thumbnail')) {
            $data = array_merge(
                $data,
                [ 'thumbnail' => $this->storeThumbnail($request) ]
            );
        }

        $updatedPost = $this->repository->update($post, $data);

        if($updatedPost)
        {
            return redirect()->route('posts')->with('success', 'The post has updated successfully!');
        }

        return redirect()->back()->withErrors(['errors' => 'There is an issue. Please try again!']);

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


    protected function storeThumbnail(Request $request) : string
    {
        $extension = $request->file('thumbnail')->extension();
        $thumbnail = Str::slug($request->input('title')) . '-' . time() . '.' . $extension;

        $request->file('thumbnail')->storeAs('thumbnails/', $thumbnail, 'uploads');

        return $thumbnail;
    }
}
