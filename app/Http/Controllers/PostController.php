<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Repository\Contracts\PostRepositoryInterface;
use App\Repository\Contracts\CategoryRepositoryInterface;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Post Repository Interface
     *
     * @var \App\Repository\Contracts\PostRepositoryInterface
     */
    protected $repository;

    /**
     * Category Repository Interface
     *
     * @var \App\Repository\Contracts\CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Request
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * DI request, post and category repositories
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\PostRepositoryInterface $repository
     * @param \App\Repository\Contracts\CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Request $request,
        PostRepositoryInterface $repository,
        CategoryRepositoryInterface $categoryRepository)
    {
        $this->request = $request;
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // get data from request
        $data = $this->validateRequest();
        // Save Post
        $createdPost = $this->repository->save( $data );
        // redirect incoming request
        return $this->sendResponse($createdPost, 'created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.single', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = "Update Post";
        $description = "{$post->title}";
        $categories = $this->categoryRepository->all();

        return view('dashboard.posts.update', [
            'post' => $post,
            'title' => $title,
            'description' => $description,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        // get data from request
        $data = $this->validateRequest($post->id);
        // Save Post
        $updatedPost = $this->repository->update($post, $data);
        // redirect incoming request
        return $this->sendResponse($updatedPost, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Delete post
        $deletedPost = $this->repository->delete($post);
        // redirect incoming request
        return $this->sendResponse($deletedPost, 'deleted');
    }

    /**
     * Upload summer note image
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        if($request->hasFile('upload_image'))
        {
            $image = $this->storeThumbnail($request, 'upload_image');
            return response()->json([
                'success' => true,
                'msg' => 'Image has been saved',
                'image' => $image,
                'path' => asset('uploads/thumbnails/' . $image)
            ]);
        }

        return response()->json(['error' => 'There is an issue']);
    }

    /**
     * Store images functionality
     *
     * @param \Illuminate\Http\Request $request
     * @return string $thumbnail stored thumbnail name
     */
    protected function storeThumbnail(Request $request, string $file_name) : string
    {
        $extension = $request->file($file_name)->extension();
        $random_chars = ($request->title) ? Str::slug($request->title) : Str::random();
        $thumbnail = $random_chars . '-' . time() . '.' . $extension;

        $request->file($file_name)->storeAs('thumbnails/', $thumbnail, 'uploads');

        return $thumbnail;
    }

    /**
     * Validate incoming request and return its data
     *
     * @param int $post_id
     * @return array
     */
    protected function validateRequest(int $post_id = null) : array
    {
        // Validation rules: If the post_id isn't null which mean we're in update case check unique on it's title
        $rules = [
            'title' => ($post_id) ? 'required|unique:posts,title,' . $post_id : 'required|unique:posts',
            'body' => 'required',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
            'categories' => 'sometimes|nullable',
            'tags' => 'sometimes|nullable',
            'is_published' => 'sometimes',
        ];
        // Assaign validated data
        $data = $this->request->validate($rules);
        // Save post thumbnail
        if($this->request->hasFile('thumbnail'))
        {
            $thumbnail = $this->storeThumbnail($this->request, 'thumbnail');
            $data = array_merge($data, ['thumbnail' => $thumbnail]);
        }
        // return the request data after validation in array format
        return $data;
    }

    /**
     * Redirect to corresponding web route
     *
     * @param mixed $post
     * @param string $action process action type: Delete|Update|Create
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($post, string $action)
    {
        // Success redirect
        if($post)
        {
            return redirect()
                    ->route('posts')
                    ->with('success', "The post has $action successfully!");
        }
        // Error redirect
        return redirect()
                ->back()
                ->withErrors(['errors' => 'There is an issue. Please try again!']);
    }
}
