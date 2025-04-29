<?php

namespace App\Http\Requests\Status;

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
            'with_closed' => ['boolean'],
            'project_id' => ['required']
        ];
    }
}
