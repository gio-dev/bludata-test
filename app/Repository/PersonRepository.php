<?php


namespace App\Repository;

use App\Models\Person;
use App\Repository\Interfaces\PersonRepositoryInterface;
use App\Traits\BaseRepository;

class PersonRepository implements PersonRepositoryInterface
{
    use BaseRepository;

    /**
     * Person constructor.
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->setEntityClass($person);
    }
}