<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GamesFormRequest extends FormRequest
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
            'club_a_id' => ['required'],
            'club_b_id' => ['required'],
            'date'      => ['required'],
            'hour'      => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'club_a_id.required'        => 'O campo Time A obrigatório.',
            'club_b_id.required'        => 'O campo Time B obrigatório.',
            'date.required'             => 'O campo data obrigatório.',
            'hour.required'             => 'O campo hora obrigatório.',
        ];
    }
}
