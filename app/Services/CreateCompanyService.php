<?php

namespace App\Services;

use App\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class CreateCompanyService
{
    public function createCompanyAuthUser(array $data): Builder|Model
    {
        return Company::query()->create(array_merge(['user_id' => auth()->user()->id], $data));
    }
}
