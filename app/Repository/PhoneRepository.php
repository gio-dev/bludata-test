<?php


namespace App\Repository;

use App\Models\Phone;
use App\Repository\Interfaces\PhoneRepositoryInterface;
use App\Traits\BaseRepository;

class PhoneRepository implements PhoneRepositoryInterface
{
    use BaseRepository;

    /**
     * State constructor.
     * @param Phone $phone
     */
    public function __construct(Phone $phone)
    {
        $this->setEntityClass($phone);
    }
}