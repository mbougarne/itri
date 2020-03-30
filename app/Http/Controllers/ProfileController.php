<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Repository\Contracts\CrudRepositoryInterface;

class ProfileController extends Controller
{
    protected Request $request;
    protected CrudRepositoryInterface $repository;

    public function __construct(Request $request, CrudRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if($this->request->has('avatar'))
        {
            $ext = $this->request->file('avatar')->extension();
            $avatar = $this->request->first_name . '-' . time() . '.' . $ext;
            $this->request->file('avatar')->storeAs('avatars/', $avatar, 'uploads');
        }

        $createdProfile = $this->repository->save($this->validateRequest());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('templates.default.users.single', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('templates.default.users.update', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile)
    {
        if($this->request->has('avatar'))
        {
            $ext = $this->request->file('avatar')->extension();
            $avatar = $this->request->first_name . '-' . time() . '.' . $ext;
            $this->request->file('avatar')->storeAs('avatars/', $avatar, 'uploads');
        }

        $createdProfile = $this->repository->update($profile, $this->validateRequest());
    }

    protected function validateRequest()
    {
        return $this->request->validate([
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'bio' => 'sometimes|nullable',
            'avatar' => 'sometimes|nullable|image|size:5000',
            'phone' => 'sometimes|nullable',
            'facebook' => 'sometimes|nullable',
            'twitter' => 'sometimes|nullable',
            'linkedin' => 'sometimes|nullable',
            'github' => 'sometimes|nullable',
            'youtube' => 'sometimes|nullable',
            'website' => 'sometimes|nullable|url',
            'business_email' => 'sometimes|nullable|email',
        ]);
    }
}
