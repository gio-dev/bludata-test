<?php

namespace App\Http\Requests\Provider;

use App\Enums\ModelPersonType;
use App\Models\Company;
use App\Repository\CompanyRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateProviderRequest extends FormRequest
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

        $company = (new Company())->whereId($this->company_id)->first();
        $rules =  [
            'name' => 'required|string|max:255',
            "document" => 'required|string|cpf_ou_cnpj|formato_cpf_ou_cnpj',
            'company_id' => 'required|integer|exists:people,id',
            'model' => ['required','string','max:1', Rule::in([ModelPersonType::PF,ModelPersonType::PJ])],
            'rg' => 'nullable|string|max:255',
            'birthdate' => 'nullable|string|date|birthdate',
            'phones' => 'nullable|array',
            'phones.value' => 'nullable|string|celular_com_ddd',
        ];
        if(validaCPF($this->document)){
            $rules['birthdate'] = 'required|string|date|birthdate';
            $rules['rg'] = 'required|string|max:255';
        }
        if($company->state->uf == "PR" && validaCPF($this->document)){
            $rules['birthdate'] = 'required|string|date|birthdate|birth_maior_idade';
        }
        return $rules;
    }
}
