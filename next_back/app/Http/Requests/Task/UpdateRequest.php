<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use App\Repositories\PriorityRepositories;
use App\Repositories\StatusRepositories;
use App\Repositories\TrackerRepositories;
use App\Rules\CheckBelongsToProject;
use Illuminate\Foundation\Http\FormRequest;

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
            'task' => ['required'],
            'brief_description' => ['required', 'max:50', 'min:30'],
            'project_id' => ['required', 'exists:projects,id'],
            'responsible_id' => ['nullable', 'exists:users,id'],
            'reviewer_id' => ['nullable', 'exists:users,id'],
            'tracker_id' => ['required', 'exists:trackers,id', new CheckBelongsToProject(new TrackerRepositories, $this->project_id)],
            'priority_id' => ['required', 'exists:priorities,id', new CheckBelongsToProject(new PriorityRepositories, $this->project_id)],
            'status_id' => ['required', 'exists:statuses,id', new CheckBelongsToProject(new StatusRepositories, $this->project_id)],
            'date_end' => ['nullable', 'date', 'after_or_equal:today'],
            'tz' => [
                'nullable',
                'array'
            ],
            'tz.*' => [
                'file',
                'mimes:pdf,jpeg,png,jpg,docx,xlsx',
                'max:2048'
            ]
        ];
    }
}
