<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRequest extends FormRequest
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
            'with_closed' => ['boolean'],
            'project_id' => ['required', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'with_closed' => '# Атрибут должен быть boolean',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters(), $this->attributes());
    }
}
