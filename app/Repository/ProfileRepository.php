<?php

namespace App\Repository;

use App\Models\Profile;
use App\Repository\Contracts\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    /**
     * Get profile
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function single()
    {
        return Profile::first();
    }

    /**
     * Create new profile
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function save(array $data)
    {
        return Profile::create($data);
    }

    /**
     * Update an existing profile
     *
     * @param \App\Models\Profile $profile
     * @param array $data profile data
     * @return \Illuminate\Database\Eloquent\Model|Boolean
     */
    public function update(Profile $profile, array $data)
    {
        return $profile->update($data);
    }
}
