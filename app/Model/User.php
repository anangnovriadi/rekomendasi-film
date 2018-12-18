<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tb_users';
    protected $fillable = ['nama_user', 'nama_film_liked', 'genre_film_liked'];
}