<?php

namespace App\Repository\Contracts;

use App\Models\Profile;

interface ProfileRepositoryInterface
{
    /**
     * Get profile
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single();

    /**
     * Create new Profile
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data);

    /**
     * Update an existing Profile
     *
     * @param \App\Models\Profile $profile
     * @param array $data Profile data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Profile $profile, array $data);

    /**
     * Delete a Profile
     *
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function delete(Profile $profile);
}
