<?php

namespace App\Filters;

use App\Traits\QueryFilters;

class PersonsFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [];

}
