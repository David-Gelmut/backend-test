<?php

namespace App\Services;

use App\DTO\CompanyData;
use App\Exceptions\CompanyException;
use App\Exceptions\DaDataException;
use App\Http\Resources\CompanyResourceCollection;
use App\Models\Company;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CompanyService
{
    public function getCompanies()
    {
        try {
            return Company::where('user_id', auth()->id())->paginate(5);
        } catch (\Exception $e) {
            throw new CompanyException($e->getMessage(), in_array($e->getCode(), [503, 404, 403]) ? $e->getCode() : 500);
        }
    }

    public function createCompanyAuthUser(string $inn): array
    {
        try {
            $response = (
            new DaDataService(config('dadata.url'), config('dadata.token')))
                ->findByInn(["query" => $inn]);
            $code = $response->getStatusCode();
            if ($code !== 200) {
                throw new DaDataException($response->object()->message, $code);
            }
            $resultArray = CompanyData::collect($response->collect('suggestions'), Collection::class)->toArray();
            $companies = auth()->user()->companies()->createMany($resultArray);
            if (count($companies) == 0) {
                return [
                    'data' => [
                        'Контрагентыы с ИНН ' . $inn . ' не найдены для пользователя с ID = ' . auth()->id()
                    ],
                    'code' => Response::HTTP_NOT_FOUND
                ];
            } else {
                return [
                    'data' => [
                        'Контрагенты с ИНН ' . $inn . ' успешно созданы для пользователя с ID = ' . auth()->id(),
                        new CompanyResourceCollection($companies)
                    ],
                    'code' => Response::HTTP_OK
                ];
            }
        } catch (\Exception $e) {
            throw new CompanyException($e->getMessage(), in_array($e->getCode(), [503, 404, 403]) ? $e->getCode() : 500);
        }
    }

    public function searchCompanies(?string $search)
    {
        try {
            return auth()->user()->companies()->search($search)->paginate(5);
        } catch (\Exception $e) {
            throw new CompanyException($e->getMessage(), in_array($e->getCode(), [503, 404, 403]) ? $e->getCode() : 500);
        }
    }
}
