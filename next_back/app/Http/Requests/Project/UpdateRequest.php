<?php

namespace App\Http\Requests\Project;

use App\Rules\Project\CheckClose;
use App\Rules\Project\UniqueNameRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:projects,id', new CheckClose],
            'name' => ['required', 'string', 'max:10', 'min:2', new UniqueNameRule($this->input('id'))],
            'description' => ['required', 'string', 'min:10', 'max:50']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => '# ID должен существовать',
            'id.exists' => '# Проект отсутсвует в базе',
            'id.numeric' => '# id должем быть numeric',
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
            'description.required' => '# Поле "Описание" обязательно для заполнения.',
            'description.string' => '# Поле "Описание" должно быть строкой.',
            'description.max' => '# Поле "Описание" не должно превышать :max символов.',
        ];
    }
    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
