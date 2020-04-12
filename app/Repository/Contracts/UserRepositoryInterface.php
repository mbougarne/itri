<?php

namespace App\Repository\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Get user
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single();

    /**
     * Create new user
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing user
     *
     * @param \App\Models\User $user
     * @param array $data user data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(User $user, array $data);

    /**
     * Delete a user
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(User $user);
}
