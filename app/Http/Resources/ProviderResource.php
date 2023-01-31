<?php

namespace App\Http\Resources;

use App\Core\Resources\AppJsonResource;

class ProviderResource extends AppJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'identify' => $this->id,
            'name' => $this->name,
            'cpf_cnpj' => $this->document,
            'company' => new CompanyProviderResource($this->company),
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'phones' => PhoneResource::collection($this->phones)
        ];
    }
}
