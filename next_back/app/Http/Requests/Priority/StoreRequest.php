<?php

namespace App\Http\Requests\Priority;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class StoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required',
            'name' => ['required',
                'string',
                'max:20',
                'min:2',
                Rule::unique('priorities')->where(function (Builder $query) {
                    $query->where('project_id', $this->project_id);
                })
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => '# Должен быть id проекта',
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
            'name.unique' => '# Статус с таким названием уже существует.',
        ];
    }
}
