<?php

namespace App\DTO;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;


class CompanyData extends Data
{
    public function __construct(
        #[MapInputName('data.inn')]
        public ?string $inn,
        #[MapInputName('data.ogrn')]
        public ?string $ogrn,
        #[MapInputName('data.name.short_with_opf')]
        public ?string $name,
        #[MapInputName('data.address.unrestricted_value')]
        public ?string $address,

    ) {
    }
}
