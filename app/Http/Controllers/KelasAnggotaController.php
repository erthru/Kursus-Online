<?php

namespace App\Http\Controllers;

use App\KelasAnggota;
use Illuminate\Http\Request;

class KelasAnggotaController extends Controller
{
    public function checkAnggota(Request $request)
    {
        $rsp = [
            'data' => KelasAnggota::with(['siswa','kelas'])
                ->where('siswa_id', $request->query('siswa_id'))
                ->orderBy('id','DESC')
                ->paginate(15)
        ];

        return $rsp;
    }
}
