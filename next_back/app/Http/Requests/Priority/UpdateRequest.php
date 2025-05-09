<?php

namespace App\Http\Requests\Priority;

use App\Http\Requests\BaseRequest;
use App\Repositories\PriorityRepositories;
use App\Repositories\StatusRepositories;
use App\Rules\CheckClosed;
use App\Rules\UniqueName;
use App\Rules\UniqueNameByProjectId;

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
            'name' => ['required', 'string', 'max:20', 'min:2', new UniqueNameByProjectId($this->input('id'), $this->project_id, new PriorityRepositories())],
            'id' => ['required', 'numeric', 'exists:priorities,id', new CheckClosed(new PriorityRepositories())],
            'project_id' => ['required']
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
