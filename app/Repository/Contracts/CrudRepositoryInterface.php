<?php

namespace App\Repository\Contracts;

interface CrudRepositoryInterface
{
    public function getAll() : object;

    public function paginate(int $limit = 15) : object;

    public function getItem() : object;

    public function getItemByKey(string $key, $value) : object;

    public function save(array $data);

    public function update($model_instance, array $data);

    public function delete($model_instance);
}
