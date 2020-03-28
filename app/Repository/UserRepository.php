<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Contracts\CrudRepositoryInterface;

class UserRepository implements CrudRepositoryInterface
{
    public function getAll() : object
    {
        return User::all();
    }

    public function paginate(int $limit = 15) : object
    {
        return User::paginate($limit);
    }

    public function getItem() : object
    {
        return User::first();
    }

    public function getItemByKey(string $key, $value) : object
    {
        return User::where($key, $value)->first();
    }

    public function save(array $data)
    {
        return User::create($data);
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
