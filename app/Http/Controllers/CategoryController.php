<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000'
        ]);

        $data = $request->all();

        if($request->hasFile('thumbnail'))
        {
            $extension = $request->file('thumbnail')->extension();
            $thumbnail = Str::random() . '-' . time() . '.' . $extension;

            $request->file('thumbnail')->storeAs('categories/', $thumbnail, 'uploads');

            unset($data['thumbnail']);

            $data = array_merge($data, ['thumbnail' => $thumbnail]);
        }

        $createdCategory = $this->repository->save($data);

        if($createdCategory)
        {
            return redirect()->route('categories')->with('success', "The category has been created");
        }

        return redirect()->back()->withErrors(['errors' => 'There is an issue. Please try again!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
        //
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
}
