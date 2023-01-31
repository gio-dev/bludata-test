<?php


namespace App\Repository;

use App\Models\State;
use App\Repository\Interfaces\StateRepositoryInterface;
use App\Traits\BaseRepository;

class StateRepository implements StateRepositoryInterface
{
    use BaseRepository;

    /**
     * State constructor.
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->setEntityClass($state);
    }
}