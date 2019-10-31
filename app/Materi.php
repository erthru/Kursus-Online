<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';
    protected $fillable = ['tipe','kelas_id'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','kelas_id','id');
    }

    public function materi()
    {
        return $this->hasMany('App\MateriMateri','materi_id','id');
    }

    public function kuis()
    {
        return $this->hasMany('App\MateriKuis','materi_id','id');
    }
}
