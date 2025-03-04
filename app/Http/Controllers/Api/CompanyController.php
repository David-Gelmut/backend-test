<?php

namespace App\Http\Controllers\Api;

use App\DTO\CompanyDTO;
use App\Exceptions\CompanyException;
use App\Http\Requests\Api\CompanyCreateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CreateCompanyService;
use App\Services\DaDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CompanyController extends BaseController
{
    public function index():JsonResponse
    {
        try {
            $authUserId = auth()->user()->id;
            $companies = Company::where('user_id',$authUserId)->get();
            return $this->sendResponse(CompanyResource::collection($companies),'List of user companies with ID = '.$authUserId,Response::HTTP_OK);
        } catch (CompanyException $e) {
            return $this->sendError($e->getMessage(),[],$e->getCode());
        }
    }

    public function store(CompanyCreateRequest $request):JsonResponse
    {
        try {
            $data = $request->validated();
            $resultDaData = app(DaDataService::class)->findById(["query" => $data['inn'], "count" => 1]);
            $company = app(CreateCompanyService::class)->createCompany(new CompanyDTO($resultDaData));
            return  $this->sendResponse(new CompanyResource($company),'A company has been created for a user with ID = '.auth()->user()->id,Response::HTTP_CREATED);
        } catch (CompanyException $e){

            return $this->sendError($e->getMessage(),[],$e->getCode());
        }
    }
}
