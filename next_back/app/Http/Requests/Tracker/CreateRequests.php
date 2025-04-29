<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateRequests extends FormRequest
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
            'project_id' => 'required',
            'name' => ['required', 'string', 'max:20', 'min:2', Rule::unique('trackers')->where(function (Builder $query) {
                $query->where('project_id', $this->project_id);
            })],
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
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
            'name.unique' => '# Трекер с таким названием уже существует.',
            'project_id.required' => '# ID проекта обязателен1'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
