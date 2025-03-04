<?php

namespace App\Services;

use App\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class CreateCompanyService
{
    public function createCompany(CompanyDTO $data): Builder|Model
    {
        $fieldsCompany = $data->toArray();
        $fieldsCompany['user_id'] = auth()->user()->id;
        return Company::query()->create($fieldsCompany);
    }
}
