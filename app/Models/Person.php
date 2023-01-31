<?php

namespace App\Models;

use App\Filters\PersonsFilters;
use App\Scopes\PersonTypeScope;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory, Filterable;

    protected $table = 'people';

    protected $default_filters = PersonsFilters::class;

    protected $fillable = [
        'name',
        'type',
        'model',
        'document',
        'birthdate',
        'rg',
        'state_id',
        'company_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new PersonTypeScope());
    }

}
