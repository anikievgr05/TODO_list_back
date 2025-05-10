<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

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
            'project_id' => 'required|exists:projects,id',
            'responsible_id' => 'nullable|exists:users,id',
            'priority_id' => 'nullable|exists:priorities,id',
            'status_id' => 'nullable|exists:statuses,id',
            'tracker_id' => 'nullable|exists:trackers,id',
            'order_by_field' => 'nullable|string|in:id,priority_id,status_id,tracker_id,date',
            'order_by_method' => 'nullable|string|in:asc,desc',
            'page' => 'nullable|integer',
            'is_closed' => 'nullable|boolean',
        ];
    }
}
