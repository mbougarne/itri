<?php

namespace App\Repository\Contracts;

interface CrudRepositoryInterface
{
    public function getAll() : array;

    public function paginate(int $limit = 15) : array;

    public function getItem() : array;

    public function getItemByKey(string $key, $value);

    public function save(array $data) : bool;

    public function update(array $data) : bool;

    public function delete($model_instance) : bool;
}
