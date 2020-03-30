<?php

namespace App\Repository;

use App\Models\Profile;
use App\Repository\Contracts\CrudRepositoryInterface;

class ProfileRepository implements CrudRepositoryInterface
{
    public function getAll() : object
    {
        return Profile::all();
    }

    public function paginate(int $limit = 15) : object
    {
        return Profile::paginate($limit);
    }

    public function getItem() : object
    {
        return Profile::first();
    }

    public function getItemByKey(string $key, $value) : object
    {
        return Profile::where($key, $value)->first();
    }

    public function save(array $data)
    {
        return Profile::create($data);
    }

    public function update($user, array $data)
    {
        return $user->update($data);
    }

    public function delete($user)
    {
        return $user->delete();
    }
}
