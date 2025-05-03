<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'with_fired' => 'boolean',
            'project_id' => 'integer', 'exists:projects,id',
        ];
    }
}
