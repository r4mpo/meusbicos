<?php

namespace App\Models\Vacancies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        "zip_code",
        "street",
        "complement",
        "neighborhood",
        "locality",
        "uf",
        "ibge",
        "gia",
        "ddd",
        "siafi"
    ];
}
