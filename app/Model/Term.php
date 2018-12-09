<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'nama_term', 'df', 'idf'
    ];
}
