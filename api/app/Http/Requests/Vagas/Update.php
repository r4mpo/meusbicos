<?php

namespace App\Http\Requests\Vagas;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "descricao_curta" => ["max:60", "min:5"],
            "descricao_longa" => ["max:250", "min:10"],
            "remuneracao" => ["int"],
            // "cep" => ["required"],
            "user_id" => ["exists:" . User::class . ',id'],
        ];
    }

    public function messages(): array
    {
        return [
            "max" => "O campo :attribute deve atingir, ao máximo, :max caracteres",
            "min" => "O campo :attribute deve atingir, ao mínimo, :min caracteres",
            // "required" => "O campo :attribute é obrigatório, tente novamente",
            "exists" => "O campo :attribute é não é válido, não existe na tabela relacionada, tente novamente",
            "integer" => "O campo :attribute deve ser um valor inteiro (neste caso, informe em centavos a remuneração)",
        ];
    }

    public function prepareForValidation(): void
    {
        $input = $this->all();

        if ($this->has('cep'))
            $input['cep'] = preg_replace("/[^0-9]/", "", $this->get('cep'));

        $this->replace($input);
    }
}