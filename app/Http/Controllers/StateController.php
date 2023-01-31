<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * @var StateService
     */
    protected $stateService;


    public function __construct(StateService $stateService)
    {
        //$this->middleware(['auth:api']);
        $this->stateService = $stateService;

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $states = $this->stateService->findAll();
        return StateResource::collection($states);
    }
}
