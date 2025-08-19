<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
        'cvegeo',
        'cve_agee',
        'nom_agee',
        'nom_abrev',
        'pob',
        'pob_fem',
        'pob_mas',
        'viv',
    ];
}
