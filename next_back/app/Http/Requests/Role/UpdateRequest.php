<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;
use App\Repositories\RoleRepositories;
use App\Rules\CheckClosed;
use App\Rules\UniqueName;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20', 'min:2', new UniqueName($this->input('id'), new RoleRepositories())],
            'id' => ['required', 'numeric', 'exists:roles,id', new CheckClosed(new RoleRepositories())],
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => '# ID должен существовать',
            'id.exists' => '# Трекер отсутсвует в базе',
            'id.numeric' => '# id должем быть numeric',
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
        ];
    }
}
