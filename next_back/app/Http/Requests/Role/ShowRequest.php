<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;
use App\Repositories\RoleRepositories;
use App\Rules\CheckClosed;

class ShowRequest extends BaseRequest
{
    private $with_closed = false;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'numeric', 'exists:roles,id', new CheckClosed(New RoleRepositories(), $this->with_closed)],
            'with_closed' => ['boolean']
        ];
    }

    public function prepareForValidation(): void
    {
        if (in_array($this->input('with_closed'), ["1", 1])) {
            $this->with_closed = (bool)$this->input('with_closed');
        }
    }

    public function messages(): array
    {
        return [
            'role.required' => 'ID долже присутсвовать',
            'role.numeric' => 'ID должен содержать число',
            'role.exists' => 'Трекера с таким ID не существет',
            'with_closed.boolean' => 'Параметр должен быть bool',
        ];
    }
}
