<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Repository\Contracts\TagRepositoryInterface;
use App\Http\Controllers\Lib\ControllerMethod;

class TagController extends Controller
{
    /**
     * Tags repository interface
     *
     * @var \App\Repository\Contracts\TagRepositoryInterface;
     */
    protected $repository;

    /**
     * Request
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Controller template methods
     *
     * @var \App\Http\Controllers\Lib\ControllerMethod;
     */
    protected $controllerMethod;


    /**
     * Make auto DI for Request, Tag Repository and Controller Method
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repository\Contracts\TagRepositoryInterface $repository
     * @param  \App\Http\Controllers\Lib\ControllerMethod $controllerMethod
     */
    public function __construct(
        Request $request,
        TagRepositoryInterface $repository,
        ControllerMethod $controllerMethod
    )
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->controllerMethod = $controllerMethod;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Tags";
        $description = "Manage posts tags";

        $links = [ 'tags' => 'All' ];

        return view('dashboard.tags.index', [
            'tags' => $this->repository->all(),
            'title' => $title,
            'description' => $description,
            'links' => $links
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $title = "Update Tag";
        $description = "{$tag->name} tag";

        return view('dashboard.tags.update', [
            'tag' => $tag,
            'title' => $title,
            'description' => $description
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag)
    {
        $data = $this->controllerMethod
                    ->validateRequest(
                        $this->requestValidationRules($tag->id));

        $updatedTag = $this->repository->update($tag, $data);

        return $this->controllerMethod
                    ->sendResponse(
                        $updatedTag,
                        'tags',
                        'tag has updated successfully',
                        'There is an error, please try again!'
                    );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $deletedTag = $this->repository->delete($tag);

        return $this->controllerMethod
                ->sendResponse(
                    $deletedTag,
                    'tags',
                    'tag has deleted successfully',
                    'There is an error, please try again!'
                );
    }

    /**
     * Request validation rules
     *
     * @param integer|null $tag_id
     * @return array $rules
     */
    protected function requestValidationRules(?int $tag_id = null) : array
    {
        $rules = [
            'name' => is_null($tag_id) ? 'required|unique:tags' : 'required|unique:tags,name,' . $tag_id,
        ];

        return $rules;
    }
}
