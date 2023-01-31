<?php

namespace App\Services;

use App\Repository\Interfaces\StateRepositoryInterface;
use App\Traits\BaseService;
/**
 * Class StateService
 * @package Apps\Services
 */
class StateService
{
    use BaseService;
    /**
     * @var StateRepositoryInterface
     */
    protected $stateRepository;

    /**
     * StateService constructor.
     * @param StateRepositoryInterface $stateRepository
     */
    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
        $this->setBaseServiceClass($stateRepository);
    }

}
