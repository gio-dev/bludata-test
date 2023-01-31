<?php

namespace App\Models;

use App\Enums\PersonsType;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Company extends Person
{
    use HasFactory, Filterable;

    protected $typeModel = PersonsType::COMPANIES;

    /**
     * @return string
     */
    public function getTypeModel(){
        return $this->typeModel;
    }

    public function state(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function providers(){
        return $this->hasMany(Providers::class, 'company_id');
    }
}
