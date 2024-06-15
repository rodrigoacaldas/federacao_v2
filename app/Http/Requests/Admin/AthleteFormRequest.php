<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AthleteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'birthday' => ['required'],
            'club_id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O campo Nome é obrigatório.',
            'birthday.required'     => 'O campo Nascimento é obrigatório.',
            'club_id.integer'       => 'O campo Clube deve ser um numero.',
            'club_id.required'      => 'O campo Clube é obrigatório.',
        ];
    }
}
