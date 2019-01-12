<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'nama_film', 'genre', 'aktor_aktris', 'nama_slug',
        'tahun', 'produksi', 'negara', 'deskripsi_film', 'image_film',
        'rating', 'kelas', 'coming'
    ];
}