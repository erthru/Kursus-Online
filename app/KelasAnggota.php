<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasAnggota extends Model
{
    protected $table = 'kelas_anggotas';
    protected $fillable = ['kelas_id', 'siswa_id'];

    public function kelas()
    {
        return $this->belongsToMany('App/Kelas', 'kelass', 'id', 'kelas_id');
    }

    public function siswa()
    {
        return $this->belongsToMany('App/Siswa', 'siswas', 'id', 'siswa_id');
    }
}
