<?php

namespace App\Services;

use App\Models\Providers;
use App\Repository\Interfaces\PhoneRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Traits\BaseService;
/**
 * Class ProvidersService
 * @package Apps\Services
 */
class ProvidersService
{
    use BaseService;
    /**
     * @var ProviderRepositoryInterface
     */
    protected $providerRepository;


    /**
     * @var PhoneRepositoryInterface
     */
    protected $phoneRepository;

    /**
     * ProvidersService constructor.
     * @param ProviderRepositoryInterface $providerRepository
     */
    public function __construct(ProviderRepositoryInterface $providerRepository, PhoneRepositoryInterface $phoneRepository)
    {
        $this->providerRepository = $providerRepository;
        $this->phoneRepository = $phoneRepository;
        $this->setBaseServiceClass($providerRepository);
    }

    public function storePhones(Providers $provider,array $phones){
        if(is_array($phones)){

            $this->setBaseServiceClass($this->phoneRepository);
            foreach ($phones as $key => $phone){
                if(is_array($phone)) {
                    foreach ($phone as $key => $ph){
                        $this->storeNew(['company_id' => $provider->id,'phone' => $ph['value']]);
                    }
                } else {
                    $this->storeNew(['company_id' => $provider->id,'phone' => $phone]);
                }
            }
            $this->setBaseServiceClass($this->providerRepository);
        }
    }
}
