<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $fillable = ['nama_depan','nama_belakang','alamat','telp','email','password'];

    public function siswaSaldo()
    {
        return $this->hasOne('App/SiswaSaldo');
    }

    public function kelasAnggota()
    {
        return $this->hasMany('App/KelasAnggota','siswa_id','id');
    }
}
