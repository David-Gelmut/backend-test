<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CompanyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyCreateRequest;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'Список компаний пользователя с ID = ' . auth()->id(),
                CompanyResource::collection($this->companyService->getCompanies()),
            ], Response::HTTP_OK
            );
        } catch (CompanyException $e) {
            report($e);
            return response()->json($e->getMessage());
        }
    }

    public function store(CompanyCreateRequest $request): JsonResponse
    {
        try {

            $resultCreateCompany = $this->companyService->createCompanyAuthUser($request->validated('inn'));
            return response()->json(
                data_get($resultCreateCompany, 'data'),
                data_get($resultCreateCompany, 'code')
            );
        } catch (CompanyException $e) {
            report($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
