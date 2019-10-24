<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'pengajars';
    protected $fillable = ['nama_depan', 'nama_belakang', 'telp', 'email', 'password'];

    public function kelas()
    {
        return $this->hasMany('App/Kelas','pengajar_id','id');
    }

    public function pengajarSaldo()
    {
        return $this->hasOne('App/PengajarSaldo');
    }
}
