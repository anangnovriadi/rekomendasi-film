<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cosine extends Model
{
    protected $fillable = [
        'id_film', 'tf_idf_sum'
    ];
}
