<?php

namespace App\Http\Controllers\Inertia;

use App\Exceptions\CompanyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyCreateRequest;
use App\Http\Requests\Inertia\CompanySearchRequest;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {
    }

    public function index(): Response
    {
        try {
            return Inertia::render('Company/Index', [
                'companies' => $this->companyService->getCompanies()
            ]);
        } catch (CompanyException $e) {
            report($e);
            if (!app()->environment('local') && in_array($e->getCode(), [500, 503, 404, 403])) {
                return Inertia::render('Errors/Error', ['status' => $e->getCode()]);
            } else {
                throw new CompanyException($e->getMessage(), $e->getCode());
            }
        }
    }

    public function store(CompanyCreateRequest $request): RedirectResponse
    {
        try {
            $resultCreateCompany = $this->companyService->createCompanyAuthUser($request->validated('inn'));
            return back()->with('alert_success', data_get($resultCreateCompany, 'code'));
        } catch (CompanyException $e) {
            report($e);
            return back()->with('alert_error', $e->getCode());
        }
    }

    public function search(CompanySearchRequest $request): Response
    {
        try {
            $companies =  $this->companyService->searchCompanies($request->validated('search'));
            if (count($companies) > 0) {
                return Inertia::render('Company/Index', [
                    'companies' => $companies
                ]);
            } else {
                return Inertia::render('Company/Search');
            }
        } catch(CompanyException $e){
            report($e);
            if (!app()->environment('local') && in_array($e->getCode(), [500, 503, 404, 403])) {
                return Inertia::render('Errors/Error', ['status' => $e->getCode()]);
            } else {
                throw new CompanyException($e->getMessage(), $e->getCode());
            }
        }
    }
}
