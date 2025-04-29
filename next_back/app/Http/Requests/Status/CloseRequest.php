<?php

namespace App\Http\Requests\Status;

use App\Http\Requests\BaseRequest;
use App\Rules\AgreementIsTrue;
use Illuminate\Foundation\Http\FormRequest;

class CloseRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:statuses,id'],
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
}
