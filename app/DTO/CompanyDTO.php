<?php

namespace App\DTO;


readonly class CompanyDTO
{
    public function __construct(
        public ?string $inn,
        public ?string $ogrn,
        public ?string $address,
        public ?string $name
    )
    {
    }

    public static function fromArray(?array $data): self
    {
        return new self(
            data_get($data, 'inn'),
            data_get($data, 'ogrn'),
            data_get($data, 'address.unrestricted_value'),
            data_get($data, 'name.short_with_opf'),
        );
    }

    public function toArray(): array
    {
        return [
            'inn' => $this->inn,
            'ogrn' => $this->ogrn,
            'address' => $this->address,
            'name' => $this->name,
        ];
    }
}
