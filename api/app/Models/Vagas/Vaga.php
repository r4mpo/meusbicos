<?php

namespace App\Models\Vagas;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    use HasFactory, SoftDeletes;

    public function user(): object
    {
        return $this->belongsTo(User::class);
    }
}