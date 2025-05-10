<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Rules\AgreementIsTrue;
use App\Rules\User\CheckUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'project_id' => ['required', 'numeric', 'exists:projects,id'],
            'role_id' => ['required', 'numeric', 'exists:roles,id', Rule::exists('roles', 'id')->where(function ($query) {
                $query->where('project_id', $this->input('project_id'));
            }),],
            'user' => ['required', 'numeric', 'exists:users,id'],
        ];
    }
}
