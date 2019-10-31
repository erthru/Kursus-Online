<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriKuis extends Model
{
    protected $table = 'materi_kuiss';
    protected $fillable = ['pertanyaan','jawaban','materi_id'];

    public function materi()
    {
        return $this->belongsTo('App\Materi','materi_id','id');
    }
}
