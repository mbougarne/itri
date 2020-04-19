<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Lib\ControllerMethod;
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
     * Controller Template Method
     *
     * @var \App\Http\Controllers\Lib\ControllerMethod
     */
    protected $controllerMethod;

    /**
     * DI request, post and category repositories
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\PostRepositoryInterface $repository
     * @param \App\Repository\Contracts\CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Request $request,
        ControllerMethod $controllerMethod,
        PostRepositoryInterface $repository,
        CategoryRepositoryInterface $categoryRepository)
    {
        $this->request = $request;
        $this->controllerMethod = $controllerMethod;
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
            'posts.draft' => 'Draft'
        ];

        return view('dashboard.posts.index', [
            'posts' => $this->repository->all(),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Display draft posts
     *
     * @return \Illuminate\Http\Response
     */
    public function draft()
    {
        $title = "Draft Posts";
        $description = "Manage your posts";

        $links = [
            'posts' => 'All',
            'posts.published' => 'Published',
            'posts.draft' => 'Draft'
        ];

        return view('dashboard.posts.index', [
            'posts' => $this->repository->allByStatus(0),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Display published posts
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        $title = "Published Posts";
        $description = "Manage your posts";

        $links = [
            'posts' => 'All',
            'posts.published' => 'Published',
            'posts.draft' => 'Draft'
        ];

        return view('dashboard.posts.index', [
            'posts' => $this->repository->allByStatus(),
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
        $data = $this->controllerMethod
                ->validateRequest(
                    $this->requestValidationRules(),
                    'thumbnail'
                );

        $createdPost = $this->repository->save($data);

        return $this->controllerMethod
            ->sendResponse(
                $createdPost,
                'posts',
                'Post has created successfully',
                'There is an error, please try again!'
            );
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
        $data = $this->controllerMethod
                ->validateRequest(
                    $this->requestValidationRules($post->id),
                    'thumbnail'
                );

        $updatedPost = $this->repository->update($post, $data);

        return $this->controllerMethod
            ->sendResponse(
                $updatedPost,
                'posts',
                'Post has updated successfully',
                'There is an error, please try again!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deletedPost = $this->repository->delete($post);

        return $this->controllerMethod
            ->sendResponse(
                $deletedPost,
                'posts',
                'Post has deleted successfully',
                'There is an error, please try again!'
            );
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
            $image = $this->controllerMethod->storeImage('upload_image');
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
     * Request validation rules
     *
     * @param integer|null $post_id
     * @return array $rules
     */
    protected function requestValidationRules(?int $post_id = null) : array
    {
        $rules = [
            'title' => is_null($post_id) ? 'required|unique:posts' : 'required|unique:posts,title,' . $post_id,
            'body' => 'required',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
            'categories' => 'sometimes|nullable',
            'tags' => 'sometimes|nullable',
            'is_published' => 'sometimes',
        ];

        return $rules;
    }
}
