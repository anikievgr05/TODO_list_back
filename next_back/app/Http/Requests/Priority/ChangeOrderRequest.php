<?php

namespace App\Http\Requests\Priority;

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
            'priority' => ['required', 'numeric', 'exists:priorities,id'],
            'action' => ['required', 'string', Rule::in(['up', 'down'], 'exists:priorities,id')]
        ];
    }
}
