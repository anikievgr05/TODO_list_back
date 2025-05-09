<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO нужна проверка на принадлжености роли к проекту
        return [
            'user' => 'required|integer|exists:users,id',
            'role' => 'required|integer|exists:roles,id',
            'project_id' => 'required|integer|exists:projects,id',
        ];
    }
}
