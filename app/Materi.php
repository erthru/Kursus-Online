<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';
    protected $fillable = ['judul','konten','kelas_id'];

    public function kelas()
    {
        return $this->belongsTo('App/Kelas','kelas_id','id');
    }
}
