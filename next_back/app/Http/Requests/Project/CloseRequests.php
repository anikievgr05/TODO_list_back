<?php

namespace App\Http\Requests\Project;

use App\Rules\Project\IsClosed;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CloseRequests extends FormRequest
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
            'id' => ['required', 'numeric', 'exists:projects,id'],
            'is_closed' => ['required', new IsClosed]
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => '# ID долже присутсвовать',
            'id.numeric' => '# ID должен содержать число',
            'id.exists' => '# Проект с таким ID не существет',
            'is_closed.required' => '# Соглашение должно присутсвовать',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
