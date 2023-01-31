<?php

namespace App\Providers;

use App\Repository\CompanyRepository;
use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Repository\Interfaces\PersonRepositoryInterface;
use App\Repository\Interfaces\PhoneRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Repository\Interfaces\StateRepositoryInterface;
use App\Repository\PersonRepository;
use App\Repository\PhoneRepository;
use App\Repository\ProviderRepository;
use App\Repository\StateRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonRepository::class
        );

        $this->app->bind(
            ProviderRepositoryInterface::class,
            ProviderRepository::class
        );

        $this->app->bind(
            StateRepositoryInterface::class,
            StateRepository::class
        );


        $this->app->bind(
            PhoneRepositoryInterface::class,
            PhoneRepository::class
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
