<?php

namespace App\Models;

use App\Enums\PersonsType;
use App\Filters\ProvidersFilters;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Providers extends Person
{
    use HasFactory;

    protected $typeModel = PersonsType::PROVIDERS;

    protected $default_filters = ProvidersFilters::class;

    /**
     * @return string
     */
    public function getTypeModel(){
        return $this->typeModel;
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function phones(){
        return $this->hasMany(Phone::class, 'company_id', 'id');
    }
}
