<?php

namespace App\Repositories;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;
class BaseRepositories
{
    protected Model $model;


    /**
     * Получить все записи.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Найти запись по ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Создать новую запись.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Обновить запись.
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    /**
     * Удалить запись.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $record = $this->model->find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}
