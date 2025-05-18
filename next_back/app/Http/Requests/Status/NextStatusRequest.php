<?php

namespace App\Http\Requests\Status;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class NextStatusRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'status' => 'required|integer|exists:statuses,id',
        ];
    }
}
