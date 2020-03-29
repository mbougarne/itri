<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\Contracts\CrudRepositoryInterface;
use Illuminate\Support\Facades\{Hash, Auth};

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
        $data = $this->request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,24|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = $this->repository->save($this->validateRequest());

        if($user)
        {
            Auth::login($user);
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
        $data = $this->request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'between:8,24|confirmed'
        ]);

        if(in_array('password', $data))
        {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->repository->update($user, $data);
    }

    /**
     * Log in
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $login = filter_var($this->request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->request->merge([$login => $this->request->username]);

        $credentials = $this->request->only($login, 'password');
        $remember = ($this->request->has('remember')) ? 1 : 0;

        if(Auth::attempt($credentials, $remember))
        {
            return response('Welcome', 200);
        }

        return response('Unauthorized', 401);
    }

    /**
     * Log in view
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('templates.default.login');
    }

    /**
     * Log out
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return response('Bye Bye', 200);
    }
}
