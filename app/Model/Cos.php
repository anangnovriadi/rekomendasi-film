<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cos extends Model
{
    protected $table = 'coss';
    
    protected $fillable = [
        'id_film', 'tf_idf_sum'
    ];
}