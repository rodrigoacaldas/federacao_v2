<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RefereeFormRequest extends FormRequest
{
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
            'name' => ['required'],
            'birthday' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O campo Nome é obrigatório.',
            'birthday.required'     => 'O campo Nascimento é obrigatório.',
        ];
    }
}
