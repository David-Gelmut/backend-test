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
    public function index(): JsonResponse
    {
        if (auth()->check()) {
            $authUserId = auth()->user()->id;
            $companies = Company::where('user_id', $authUserId)->get();
            return $this->sendResponse(CompanyResource::collection($companies), 'Список компаний пользователя с ID = ' . $authUserId, Response::HTTP_OK);
        }
        return $this->sendError('Пользователь не авторизован', [], Response::HTTP_UNAUTHORIZED);
    }

    public function store(CompanyCreateRequest $request, DaDataService $daDataService, CreateCompanyService $companyService, CompanyDTO $dto): JsonResponse
    {
        if (auth()->check()) {
            $data = $request->validated();
            $resultDaData = $daDataService->findById(["query" => $data['inn'], "count" => 1]);
            if (isset($resultDaData['suggestions'])) {
                if (count($resultDaData['suggestions']) > 0) {
                    $company = $companyService->createCompanyAuthUser($dto->prepareData($resultDaData));
                    return $this->sendResponse(new CompanyResource($company), 'Контрагент с ИНН ' . $data['inn'] . ' успешно создан для пользователя с ID = ' . auth()->user()->id, Response::HTTP_CREATED);

                } else{
                    return $this->sendResponse([], 'Контрагент с ИНН ' . $data['inn'] . ' не найден для пользователя с ID = ' . auth()->user()->id, Response::HTTP_OK);
                }
            }
            return $this->sendError('Ошибка получения данных из DaData', [], Response::HTTP_OK);
        }
        return $this->sendError('Пользователь не авторизован', [], Response::HTTP_UNAUTHORIZED);
    }
}
