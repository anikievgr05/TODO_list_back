<?php

namespace App\Http\Requests\Tracker;

use App\Repositories\TrackerRepositories;
use App\Rules\CheckClosed;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowRequest extends FormRequest
{
    private mixed $with_closed = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tracker' => ['required', 'numeric', 'exists:trackers,id', new CheckClosed(New TrackerRepositories(), $this->with_closed)],
            'with_closed' => ['boolean']
        ];
    }

    public function prepareForValidation(): void
    {
        if (in_array($this->input('with_closed'), ["1", 1])) {
            $this->with_closed = (bool) $this->input('with_closed');
        }
    }

    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters(), $this->attributes());
    }

    public function messages(): array
    {
        return [
            'tracker.required' => 'ID долже присутсвовать',
            'tracker.numeric' => 'ID должен содержать число',
            'tracker.exists' => 'Трекера с таким ID не существет',
            'with_closed.boolean' => 'Параметр должен быть bool',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
