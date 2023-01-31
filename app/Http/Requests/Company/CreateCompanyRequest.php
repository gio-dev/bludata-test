<?php

namespace App\Http\Requests\Company;

use App\Enums\ModelPersonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            "document" => 'required|string|cnpj|formato_cnpj',
            'state_id' => 'required|integer|exists:states,id',
            'model' => ['required','string','max:1', Rule::in([ModelPersonType::PJ])],
        ];
    }
}
