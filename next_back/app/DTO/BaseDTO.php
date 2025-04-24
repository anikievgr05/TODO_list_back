<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Model;

abstract class BaseDTO
{
    /**
     * Конструктор DTO.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->mapData($data);
    }

    /**
     * Преобразование массива данных в свойства DTO.
     *
     * @param array $data
     * @return void
     */
    protected function mapData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Получение значения по ключу.
     *
     * @param string $key
     * @param mixed $default Значение по умолчанию, если ключ не существует
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->$key;
    }

    /**
     * Преобразование DTO в массив.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Создание DTO из массива данных.
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new static($data);
    }

    /**
     * Создание DTO из модели.
     *
     * @param Model $model
     * @return static
     */
    public static function fromModel(Model $model): self
    {
        // Преобразуем модель в массив и создаем DTO
        return new static($model->toArray());
    }
}
