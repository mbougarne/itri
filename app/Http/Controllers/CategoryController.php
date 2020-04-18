<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Http\Controllers\Lib\ControllerMethod;

class CategoryController extends Controller
{
    /**
     * Category Repository Interface
     *
     * @var \App\Repository\Contracts\CategoryRepositoryInterface $repository
     */
    protected $repository;

    /**
     * Request object
     *
     * @var \Illuminate\Http\Request $request
     */
    protected $request;

    /**
     * Controller Template Method
     *
     * @var \App\Http\Controllers\Lib\ControllerMethod
     */
    protected $controllerMethod;
    /**
     * Assign request and category repository on instantiate
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\CategoryRepositoryInterface $repository
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
        $data = $this->controllerMethod
                ->validateRequest(
                    $this->requestValidationRules(),
                    'thumbnail',
                    'categories'
                );

        $createdCategory = $this->repository->save($data);

        return $this->controllerMethod
                ->sendResponse(
                    $createdCategory,
                    'categories',
                    'category has created successfully',
                    'There is an error, please try again!'
                );
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
    public function update(Category $category)
    {
        $data = $this->controllerMethod
                    ->validateRequest(
                        $this->requestValidationRules($category->id),
                        'thumbnail',
                        'categories'
                    );

        $createdCategory = $this->repository->update($category, $data);

        return $this->controllerMethod
                    ->sendResponse(
                        $createdCategory,
                        'categories',
                        'category has updated successfully',
                        'There is an error, please try again!'
                    );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deletedCategory = $this->repository->delete($category);

        return $this->controllerMethod
                ->sendResponse(
                    $deletedCategory,
                    'categories',
                    'category has deleted successfully',
                    'There is an error, please try again!'
                );
    }

    /**
     * Request validation rules
     *
     * @param integer|null $category_id
     * @return array $rules
     */
    protected function requestValidationRules(?int $category_id = null) : array
    {
        $rules = [
            'parent_id' => 'sometimes|nullable|exists:categories,id',
            'name' => is_null($category_id) ? 'required|unique:categories' : 'required|unique:categories,name,' . $category_id,
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
        ];

        return $rules;
    }
}
