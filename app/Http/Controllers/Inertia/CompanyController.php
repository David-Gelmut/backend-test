<?php

namespace App\Http\Controllers\Inertia;

use App\DTO\CompanyDTO;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\CompanyCreateRequest;
use App\Http\Requests\Inertia\CompanySearchRequest;
use App\Models\Company;
use App\Services\CreateCompanyService;
use App\Services\DaDataService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends BaseController
{
    public function index(): Response
    {
        $companies = Company::where('user_id', auth()->user()->id)->paginate(5);
        return Inertia::render('Company/Index', [
            'companies' => $companies
        ]);
    }

    public function store(CompanyCreateRequest $request, DaDataService $daDataService, CreateCompanyService $companyService, CompanyDTO $dto): RedirectResponse
    {
        $data = $request->validated();
        $resultDaData = $daDataService->findById(["query" => $data['inn'], "count" => 1]);
        $companyService->createCompanyAuthUser($dto->prepareData($resultDaData));
        return redirect()->route('companies.index');
    }

    public function search(CompanySearchRequest $request): Response|RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['search']) && count($data) > 0) {
            $stringSearch = $data['search'];
            $companies = Company::query()
                ->where('user_id', auth()->user()->id)
                ->search($stringSearch)
                ->paginate(5);
            if (count($companies) > 0) {
                return Inertia::render('Company/Index', [
                    'companies' => $companies
                ]);
            } else {
                return Inertia::render('Company/Search');
            }
        }
        return redirect()->route('companies.index');
    }
}
