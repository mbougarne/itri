<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Lib\ControllerMethod;
use App\Repository\Contracts\PageRepositoryInterface;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Page Repository Interface
     *
     * @var \App\Repository\Contracts\PageRepositoryInterface
     */
    protected $repository;

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
     * DI request, controller method and  page repositories
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Controllers\Lib\ControllerMethod $controllerMethod
     * @param \App\Repository\Contracts\PageRepositoryInterface $repository
     */
    public function __construct(
        Request $request,
        ControllerMethod $controllerMethod,
        PageRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->controllerMethod = $controllerMethod;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Pages";
        $description = "Manage your page";

        $links = [
            'pages' => 'All',
            'pages.published' => 'Published',
            'pages.draft' => 'Draft'
        ];

        return view('dashboard.pages.index', [
            'pages' => $this->repository->all(),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Display draft pages
     *
     * @return \Illuminate\Http\Response
     */
    public function draft()
    {
        $title = "Draft Pages";
        $description = "Manage your pages";

        $links = [
            'pages' => 'All',
            'pages.published' => 'Published',
            'pages.draft' => 'Draft'
        ];

        return view('dashboard.pages.index', [
            'pages' => $this->repository->allByStatus(0),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Display published pages
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        $title = "Published Pages";
        $description = "Manage your pages";

        $links = [
            'pages' => 'All',
            'pages.published' => 'Published',
            'pages.draft' => 'Draft'
        ];

        return view('dashboard.pages.index', [
            'pages' => $this->repository->allByStatus(),
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
        $title = "Create New Page";
        $description = "Use the form below to create new page";

        return view('dashboard.pages.create', [
            'title' => $title,
            'description' => $description
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

        $createdPage = $this->repository->save($data);

        return $this->controllerMethod
            ->sendResponse(
                $createdPage,
                'pages',
                'Page has created successfully',
                'There is an error, please try again!'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('dashboard.pages.single', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $title = "Update Page";
        $description = "{$page->title}";

        return view('dashboard.pages.update', [
            'page' => $page,
            'title' => $title,
            'description' => $description
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page)
    {
        $data = $this->controllerMethod
                ->validateRequest(
                    $this->requestValidationRules($page->id),
                    'thumbnail'
                );

        $updatedPage = $this->repository->update($page, $data);

        return $this->controllerMethod
            ->sendResponse(
                $updatedPage,
                'pages',
                'Page has updated successfully',
                'There is an error, please try again!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $deletedPage = $this->repository->delete($page);

        return $this->controllerMethod
            ->sendResponse(
                $deletedPage,
                'pages',
                'Page has deleted successfully',
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

        return response()->json(['error' => 'There is an issue'], 500);
    }

    /**
     * Request validation rules
     *
     * @param integer|null $page_id
     * @return array $rules
     */
    protected function requestValidationRules(?int $page_id = null) : array
    {
        $rules = [
            'title' => is_null($page_id) ? 'required|unique:pages' : 'required|unique:pages,title,' . $page_id,
            'body' => 'required',
            'description' => 'sometimes|nullable|max:160',
            'thumbnail' => 'sometimes|nullable|file|image|max:5000',
            'is_published' => 'sometimes',
        ];

        return $rules;
    }
}
