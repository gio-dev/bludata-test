<?php

namespace App\Services;

use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Traits\BaseService;
/**
 * Class CompaniesService
 * @package Apps\Services
 */
class CompaniesService
{
    use BaseService;
    /**
     * @var CompanyRepositoryInterface
     */
    protected $companyRepository;

    /**
     * CompaniesService constructor.
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->setBaseServiceClass($companyRepository);
    }

}
