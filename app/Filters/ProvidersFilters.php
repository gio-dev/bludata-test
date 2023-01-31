<?php

namespace App\Filters;

use App\Traits\QueryFilters;

class ProvidersFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = ['name', 'document'];

    public function createdatgreater($term)
    {
        if(!is_null($term) && !empty(trim($term))){
            $this->builder->where('created_at', '>=', $term);
        }
    }
    public function createdatless($term)
    {
        if(!is_null($term) && !empty(trim($term))) {
            $this->builder->where('created_at', '<=', $term);
        }
    }
}
