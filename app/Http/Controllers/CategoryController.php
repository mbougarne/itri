<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * Category Repository Interface
     * @var \App\Repository\Contracts\CategoryRepositoryInterface $repository
     */
    protected $repository;

    /**
     * Undocumented variable
     *
     * @var \Illuminate\Http\Request $request
     */
    protected $request;

    /**
     * Assign request and category repository on instantiate
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\CategoryRepositoryInterface $repository
     */
    public function __construct(Request $request, CategoryRepositoryInterface $repository)
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
        $title = "Categories";
        $description = "Manage your categories";

        $links = [ 'categories' => 'All' ];

        return view('dashboard.categories.index', [
            'categories' => $this->repository->all(),
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
        $title = "Create New Category";
        $description = "Use the form below to create new category";
        $categories = $this->repository->all();

        return view('dashboard.categories.create', [
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
        $createdCategory = $this->repository->save($data);
        // redirect incoming request
        return $this->sendResponse($createdCategory, 'created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $title = "Create New Category";
        $description = "Use the form below to create new category";
        $categories = $this->repository->all();

        return view('dashboard.categories.create', [
            'title' => $title,
            'description' => $description,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = "Update Category";
        $description = "{$category->name} category";
        $categories = $this->repository->allWhere('id', '!=', $category->id);

        return view('dashboard.categories.update', [
            'category' => $category,
            'title' => $title,
            'description' => $description,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        return dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
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
        $random_chars = ($request->name) ? strtolower($request->name) : Str::random();
        $thumbnail = $random_chars . '-' . time() . '.' . $extension;

        $request->file($file_name)->storeAs('categories/', $thumbnail, 'uploads');

        return $thumbnail;
    }

    /**
     * Validate incoming request and return its data
     *
     * @param int|null $category_id
     * @return array
     */
    protected function validateRequest(?int $category_id = null) : array
    {
        // Validation rules: If the category_id isn't null which mean we're in update case check unique on it's name
        $rules = [
            'parent_id' => 'sometimes|nullable|exists:categories,id',
            'name' => ($category_id) ? 'required|unique:categories,name,' . $category_id : 'required|unique:categories',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
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
     * @param mixed $category
     * @param string $action process action type: Delete|Update|Create
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($category, string $action)
    {
        // Success redirect
        if($category)
        {
            return redirect()
                    ->route('categories')
                    ->with('success', "The category has $action successfully!");
        }
        // Error redirect
        return redirect()
                ->back()
                ->withErrors(['errors' => 'There is an issue. Please try again!']);
    }
}
