<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriMateri extends Model
{
    protected $table = 'materi_materis';
    protected $fillable = ['judul','konten','materi_id'];

    public function materi()
    {
        return $this->belongsTo('App\Materi','materi_id','id');
    }
}
