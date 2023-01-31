<?php


namespace App\Repository;


use App\Models\Company;

class CompanyRepository extends PersonRepository implements Interfaces\CompanyRepositoryInterface
{

    /**
     * Company constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }
}