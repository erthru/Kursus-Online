<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajarSaldo extends Model
{
    protected $table = 'pengajar_saldos';
    protected $fillable = ['saldo','pengajar_id'];

    public function pengajar()
    {
        return $this->hasOne('App/Pengajar');
    }
}
