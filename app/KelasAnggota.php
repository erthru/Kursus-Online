<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasAnggota extends Model
{
    protected $table = 'kelas_anggotas';
    protected $fillable = ['kelas_id', 'pengguna_id'];

    public function kelas()
    {
        return $this->hasOne('App\Kelas','id','kelas_id');
    }

    public function pengguna()
    {
        return $this->hasOne('App\Pengguna','id','pengguna_id');
    }
}
