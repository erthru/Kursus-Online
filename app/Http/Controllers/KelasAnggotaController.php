<?php

namespace App\Http\Controllers;

use App\KelasAnggota;
use Illuminate\Http\Request;

class KelasAnggotaController extends Controller
{
    public function all()
    {
        $rsp = [
            'data' => KelasAnggota::with(['pengguna', 'kelas'])
            ->orderBy('id','DESC')
            ->paginate(15)
        ];

        return $rsp;
    }


    public function checkAnggota(Request $request)
    {
        $rsp = [
            'data' => KelasAnggota::with(['pengguna', 'kelas'])
                ->where('pengguna_id', $request->query('pengguna_id'))
                ->where('kelas_id', $request->query('kelas_id'))
                ->first()
        ];

        return $rsp;
    }

    public function anggotaKelas(Request $request)
    {
        $rsp = [
            'data' => KelasAnggota::with(['pengguna','kelas'])
            ->where('pengguna_id', $request->query('pengguna_id'))
            ->orderBy('id','DESC')
            ->paginate(15)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'kelas_id' => $request->input('kelas_id'),
            'pengguna_id' => $request->input('pengguna_id')
        ];

        $data = KelasAnggota::where('kelas_id', $body['kelas_id'])->where('pengguna_id', $body['pengguna_id'])->first();

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
