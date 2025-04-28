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

    public function all_by_parent(int $parent_id, string $fill)
    {
        return $this->model
            ->where($fill, $parent_id)
            ->get();
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
            $record->fill($data);
            $record->save();
            return $record;
        }
        return null;
    }

    public function get_by_field(string $field, int | string $value)
    {
        return $this->model
            ->where($field, $value)
            ->first();
    }

    /**
     * получаем строки у которых $key = $value и при этом не равен $id
     *
     * @param string $key поле по которому искать
     * @param string $value значение поля для $key
     * @param int $id ID записей, которые мы должны исключить
     */
    public function get_by_key_excluding_id(string $key, string $value, int $id)
    {
        return $this->model
            ->select('id')
            ->where($key, '=', $value)
            ->where('id', '!=', $id)
            ->count();
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
