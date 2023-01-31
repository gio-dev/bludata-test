<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Services\ProvidersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * @var ProvidersService
     */
    protected $providersService;


    public function __construct(ProvidersService $providersService)
    {
        //$this->middleware(['auth:api']);
        $this->providersService = $providersService;

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $providers = $this->providersService->search();
        return ProviderResource::collection($providers);
    }

    public function store(CreateProviderRequest $request): JsonResponse
    {
        $provider = $this->providersService->storeNew($request->except('phones'));
        $this->providersService->storePhones($provider,$request->only('phones'));
        return $this->responseCreated('Provider created successfully', new ProviderResource($provider));
    }

}
