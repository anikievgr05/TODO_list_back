<?php

namespace App\Http\Requests\Tracker;

use App\Rules\AgreementIsTrue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CloseRequest extends FormRequest
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
            'id' => ['required', 'numeric', 'exists:trackers,id'],
            'is_closed' => ['required', 'boolean'],
            'agreement' => ['required', 'boolean', new AgreementIsTrue($this->input('is_closed'))],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => '# ID долже присутсвовать',
            'id.numeric' => '# ID должен содержать число',
            'id.exists' => '# Проект с таким ID не существет',
            'is_closed.boolean' => '# Значение должно быть boolean',
            'agreement.required' => '# Соглашение должно быть запрлненео',
            'agreement.boolean' => '# Значение должно быть boolean',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
