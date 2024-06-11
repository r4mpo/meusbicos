<?php

namespace App\Services;

use App\Interfaces\ApiDataInterface;
use App\Models\Vacancies\AddressVacancy;

class AddressService implements ApiDataInterface
{
    public function get($url): array
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return (array) json_decode($response);
    }

    public function register($data): Object
    {
        $address = new AddressVacancy;

        $address->zip_code = preg_replace('/\D/', '', $data['cep']);
        $address->street = $data['logradouro'];
        $address->complement = $data['complemento'];
        $address->neighborhood = $data['bairro'];
        $address->locality = $data['localidade'];
        $address->uf = $data['uf'];
        $address->ibge = $data['ibge'];
        $address->gia = $data['gia'];
        $address->ddd = $data['ddd'];
        $address->siafi = $data['siafi'];

        $address->save();

        return $address;
    }
}
