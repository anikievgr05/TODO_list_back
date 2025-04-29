<?php

namespace App\Http\Requests\Tracker;

use App\Repositories\RoleRepositories;
use App\Repositories\TrackerRepositories;
use App\Rules\CheckClosed;
use App\Rules\UniqueName;
use App\Rules\UniqueNameByProjectId;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    // да, я знаю что я могу получить id используя параметр tracker, но я считаю что в этот момент жизни это не очень так и надо. по этому пусть фронт присылает мне id)
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20', 'min:2', new UniqueNameByProjectId($this->id, $this->project_id, new TrackerRepositories())],
            'id' => ['required', 'numeric', 'exists:trackers,id', new CheckClosed(new TrackerRepositories())],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => '# ID должен существовать',
            'id.exists' => '# Трекер отсутсвует в базе',
            'id.numeric' => '# id должем быть numeric',
            'name.required' => '# Поле "Название" обязательно для заполнения.',
            'name.string' => '# Поле "Название" должно быть строкой.',
            'name.max' => '# Поле "Название" не должно превышать :max символов.',
            'name.min' => '# Поле "Название" не должно быть меньше :min символов.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
