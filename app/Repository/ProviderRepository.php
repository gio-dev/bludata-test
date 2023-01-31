<?php

namespace App\Repository;

use App\Models\Providers;

class ProviderRepository extends PersonRepository implements Interfaces\ProviderRepositoryInterface
{
    /**
     * Company constructor.
     * @param Providers $providers
     */
    public function __construct(Providers $providers)
    {
        parent::__construct($providers);
    }
}