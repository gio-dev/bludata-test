<?php

namespace App\Http\Resources;

use App\Core\Resources\AppJsonResource;

class CompanyResource extends AppJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'identify' => $this->id,
            'name' => $this->name,
            'uf' => $this->state_id ? $this->state->uf : '' ,
            'cnpj' => $this->document,
            'providers' => ProviderResource::collection($this->providers)
        ];
    }
}
