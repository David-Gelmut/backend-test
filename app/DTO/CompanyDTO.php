<?php

namespace App\DTO;

class CompanyDTO
{
    public string $inn;
    public string $ogrn;
    public string $address;
    public string $name;

    public function __construct(array $args)
    {
        if ($this->validateArgs($args)) {
            $data = $args['suggestions'][0]['data'];
            $this->name = $data['name']['short_with_opf'];
            $this->inn = $data['inn'];
            $this->ogrn = $data['ogrn'];
            $this->address = $data['address']['unrestricted_value'];
        }
    }

    public function validateArgs($args): bool
    {
        if (isset($args['suggestions'][0])) {
            return true;
        }
        return false;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
