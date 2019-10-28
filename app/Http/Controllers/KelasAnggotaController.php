<?php

namespace App\Http\Controllers;

use App\KelasAnggota;
use Illuminate\Http\Request;

class KelasAnggotaController extends Controller
{
    public function checkAnggota(Request $request)
    {
        $rsp = [
            'data' => KelasAnggota::with(['siswa', 'kelas'])
                ->where('siswa_id', $request->query('siswa_id'))
                ->orderBy('id', 'DESC')
                ->paginate(15)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'kelas_id' => $request->input('kelas_id'),
            'siswa_id' => $request->input('siswa_id')
        ];

        $data = KelasAnggota::where('kelas_id', $body['kelas_id'])->where('siswa_id', $body['siswa_id'])->first();

        $rsp = [
            'data' => 'Exist'
        ];

        if ($data == null) {
            $rsp = [
                'data' => KelasAnggota::create($body)
            ];
        }

        return $rsp;
    }
}
