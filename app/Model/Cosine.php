<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cosine extends Model
{
    protected $table = 'd_products';
    
    protected $fillable = [
        'id_film', 'tf_idf'
    ];
}
