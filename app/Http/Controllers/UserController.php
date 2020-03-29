<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\Contracts\CrudRepositoryInterface;

class UserController extends Controller
{
    protected Request $request;
    protected CrudRepositoryInterface $repository;

    public function __construct(Request $request, CrudRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response('ok',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $userCreation = $this->repository->save($this->validateRequest());

        if($userCreation)
        {
            return response()->json(['created' => true], 201);
        }

        return response()->json(['message' => "There is an error"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        return $this->repository->update($user, $this->validateRequest());
    }

    protected function validateRequest()
    {
        return $this->request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'sometimes|nullable|between:8,24|confirmed'
        ]);
    }
}
