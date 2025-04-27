<?php

namespace App\Http\Requests\Project;

use App\Rules\Project\CheckClose;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetByNameRequest extends FormRequest
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
            'project' => ['required', 'string', 'exists:projects,name', new CheckClose('name')]
        ];
    }
    public function messages(): array
    {
        return [
            'project.required' => 'Имя должно присутсвовать',
            'project.string' => 'Имя должно содержать число',
            'project.exists' => 'Проект с таким именем не существет',
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
