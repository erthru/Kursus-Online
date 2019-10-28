<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $fillable = ['nama_depan', 'nama_belakang', 'alamat', 'telp', 'saldo', 'email', 'password'];

    public function kelasAnggota()
    {
        return $this->hasMany('App\KelasAnggota', 'siswa_id', 'id');
    }
}
