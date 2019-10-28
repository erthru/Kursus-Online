<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function all()
    {
        $rsp = [
            'data' => Kelas::with(['pengguna'])->orderBy('id', 'DESC')->paginate(15)
        ];

        return $rsp;
    }

    public function show($id)
    {
        $materiTotal = 0;
        $kelasAnggotaTotal = 0;

        $rsp = [
            'data' => Kelas::with(['pengguna',
                'materi' => function ($materi) use (&$materiTotal) {
                    $materiTotal = $materi->count();
                    $materi->orderBy('created_at', 'ASC')->paginate(15);
                },
                'kelasAnggota' => function ($kelasAnggota) use (&$kelasAnggotaTotal) {
                    $kelasAnggotaTotal = $kelasAnggota->count();
                    $kelasAnggota->with(['pengguna'])->orderBy('id', 'DESC')->paginate(15);
                }])
                ->find($id),
            'has_many_count' => [
                'materi' => $materiTotal,
                'kelasAnggota' => $kelasAnggotaTotal
            ]
        ];

        return $rsp;
    }

    public function search(Request $request)
    {
        $rsp = [
            'data' => Kelas::with(['pengguna'])
                ->where('nama', 'LIKE', '%' . $request->query('q') . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $request->query('q') . '%')
                ->orderBy('id', 'DESC')
                ->paginate(15)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'total_klik' => 0,
            'pengguna_id' => $request->input('pengguna_id'),
        ];

        $rsp = [
            'data' => Kelas::create($body)
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $kelas = Kelas::find($id);

        $body = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'total_klik' => 0
        ];

        $kelas->update($body);

        $rsp = [
            'data' => $kelas
        ];

        return $rsp;
    }

    public function delete($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        $rsp = [
            'data' => 204
        ];

        return $rsp;
    }
}
