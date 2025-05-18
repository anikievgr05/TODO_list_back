<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task' => 'required|integer|exists:tasks,id'
        ];
    }
}
