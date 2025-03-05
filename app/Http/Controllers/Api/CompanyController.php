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
        if(auth()->check()){
            $authUserId = auth()->user()->id;
            $companies = Company::where('user_id',$authUserId)->get();
            return $this->sendResponse(CompanyResource::collection($companies),'Список компаний пользователя с ID = '.$authUserId,Response::HTTP_OK);
        }
        return $this->sendError('Пользовател не авторизован',[],Response::HTTP_UNAUTHORIZED);
    }

    public function store(CompanyCreateRequest $request,DaDataService $daDataService,CreateCompanyService $companyService):JsonResponse
    {
        if (auth()->check()) {
            $data = $request->validated();
            $resultDaData = $daDataService->findById(["query" => $data['inn'], "count" => 1]);
            $company = $companyService->createCompanyAuthUser(new CompanyDTO($resultDaData));
            return $this->sendResponse(new CompanyResource($company), 'Компания была создана для пользователя с ID = ' . auth()->user()->id, Response::HTTP_CREATED);

        }
        return $this->sendError('Пользовател не авторизован', [], Response::HTTP_UNAUTHORIZED);

    }
}
