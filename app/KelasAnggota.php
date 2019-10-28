<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasAnggota extends Model
{
    protected $table = 'kelas_anggotas';
    protected $fillable = ['kelas_id', 'siswa_id'];

    public function kelas()
    {
        return $this->hasOne('App\Kelas','id','kelas_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Siswa','id','siswa_id');
    }
}
