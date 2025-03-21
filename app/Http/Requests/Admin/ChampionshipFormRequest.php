<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChampionshipFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required'],
            'modality_id'   => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O campo Nome é obrigatório.',
            'modality_id.required'         => 'É obrigatório escolher uma modalidade.',
        ];
    }
}
