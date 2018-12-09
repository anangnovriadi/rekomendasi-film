<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tf_idf extends Model
{
    protected $fillable = [
        'id_film', 'id_term', 'id_user', 
        'tf', 'tf_idf', 'tf_idf_kuadrat'
    ];
}
