<?php

namespace App\Http\Requests\Status;

use App\Http\Requests\BaseRequest;
use App\Repositories\RoleRepositories;
use App\Repositories\StatusRepositories;
use App\Rules\CheckClosed;
use Illuminate\Foundation\Http\FormRequest;

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
            'status' => ['required', 'numeric', 'exists:statuses,id', new CheckClosed(New StatusRepositories(), $this->with_closed)],
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
            'status.required' => 'ID долже присутсвовать',
            'status.numeric' => 'ID должен содержать число',
            'status.exists' => 'Трекера с таким ID не существет',
            'with_closed.boolean' => 'Параметр должен быть bool',
        ];
    }
}
