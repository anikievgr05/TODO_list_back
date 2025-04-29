<?php

namespace App\Http\Requests\Status;

use App\Http\Requests\BaseRequest;
use App\Repositories\StatusRepositories;
use App\Rules\CheckClosed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeOrderRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required',
            'status' => ['required', 'numeric', 'exists:statuses,id'],
            'action' => ['required', 'string', Rule::in(['up', 'down'], 'exists:statuses,id')]
        ];
    }
}
