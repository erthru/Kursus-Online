<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'penggunas';
    protected $fillable = ['nama_depan', 'nama_belakang', 'telp', 'saldo', 'email', 'password'];

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'pengguna_id', 'id');
    }
}
