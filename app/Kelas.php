<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelass';
    protected $fillable = ['nama','deskripsi','harga','total_klik','pengguna_id'];

    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna','pengguna_id','id');
    }

    public function materi()
    {
        return $this->hasMany('App\Materi','kelas_id','id');
    }

    public function kelasAnggota()
    {
        return $this->hasMany('App\KelasAnggota','kelas_id','id');
    }
}
