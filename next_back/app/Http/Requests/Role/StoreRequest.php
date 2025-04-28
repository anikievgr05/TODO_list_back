<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;

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
            'name' => ['required', 'string', 'max:20', 'min:2', 'unique:roles,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => '# Должен бытьid проекта',
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
            'name.unique' => '# Роль с таким названием уже существует.',
        ];
    }
}
