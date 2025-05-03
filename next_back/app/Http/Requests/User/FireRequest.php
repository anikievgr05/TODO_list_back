<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class FireRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_fire' => ['required' ,'boolean'],
            'project_id' => ['required','numeric', 'exists:projects,id'],
            'user' => ['required', 'numeric', 'exists:users,id']
        ];
    }
}
