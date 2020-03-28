<?php

use App\Models\User;
use App\Repository\Contracts\CrudRepositoryInterface;

class UserRepository extends CrudRepositoryInterface
{
    public function getAll() : array
    {
        return User::all();
    }

    public function paginate(int $limit = 15) : array
    {
        return User::paginate($limit);
    }

    public function getItem() : array
    {
        return User::first();
    }

    public function getItemByKey(string $key, $value)
    {
        return User::where($key, $value)->first();
    }

    public function save(array $data) : bool
    {
        return User::create([$data]);
    }

    public function update(array $data) : bool
    {
        return User::update([$data]);
    }

    public function delete($user) : bool
    {
        return $user->delete();
    }
}
