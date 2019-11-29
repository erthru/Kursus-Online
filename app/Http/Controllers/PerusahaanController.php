<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function all()
    {
        $rsp = [
            'data' => Perusahaan::first()
        ];

        return $rsp;
    }

    public function addSaldo(Request $request){
        $perusahaan = Perusahaan::first();

        $currentSaldo = (int)$perusahaan->saldo;
        $currentSaldo += (int)$request->input('saldo');

        $body = [
            'saldo' => $currentSaldo
        ];

        $perusahaan->update($body);

        $rsp = [
            'data' => $perusahaan
        ];

        return $rsp;
    }
}
