<?php

namespace App\Http\Controllers;

use App\Core\Resources\AppAnonymousResourceCollection;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Services\CompaniesService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{

    /**
     * @var CompaniesService
     */
    protected $companiesService;


    public function __construct(CompaniesService $companiesService)
    {
        //$this->middleware(['auth:api']);
        $this->companiesService = $companiesService;

    }

    public function index(): AppAnonymousResourceCollection
    {
        $companies = $this->companiesService->search();
        return CompanyResource::collection($companies);
    }

    public function show($identity): JsonResponse
    {
        $company = $this->companiesService->findOneById($identity);
        return $this->responseSuccess('Company found', new CompanyResource($company));
    }

    public function store(CreateCompanyRequest $request): JsonResponse
    {
        $company = $this->companiesService->storeNew($request->all());
        return $this->responseCreated('Company created successfully', new CompanyResource($company));
    }
}
