<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cos extends Model
{
    protected $table = 'c_products';
    
    protected $fillable = [
        'id_film', 'tf_idf'
    ];
}