<?php

namespace App\Models\Vagas;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "descricao_curta",
        "descricao_longa",
        "remuneracao",
        "cep",
        "user_id",
    ];

    public function user(): object
    {
        return $this->belongsTo(User::class);
    }
}