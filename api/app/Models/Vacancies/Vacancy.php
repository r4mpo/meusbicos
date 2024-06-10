<?php

namespace App\Models\Vacancies;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "short_description",
        "long_description",
        "wage",
        "zip_code",
        "user_id",
    ];

    protected $table = "vacancies";

    public function user(): object
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all users who applied to a vacancy
     *
     * @return object
     */
    public function users(): object
    {
        return $this->belongsToMany(User::class);
    }
}
