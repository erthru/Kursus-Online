<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function all()
    {
        $rsp = [
            'data' => Siswa::orderBy('id', 'DESC')->paginate(15)
        ];

        return $rsp;
    }

    public function show($id)
    {
        $kelasTotal = 0;

        $rsp = [
            'data' => Siswa::with(['kelasAnggota' => function ($kelasAnggota) use (&$kelasTotal) {
                $kelasAnggota->orderBy('id', 'DESC');
                $kelasTotal = $kelasAnggota->count();
            }])
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'alamat' => $request->input('alamat'),
            'telp' => $request->input('telp'),
            'saldo' => 0,
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $rsp = [
            'data' => Siswa::create($body)
        ];

        return $rsp;
    }

    public function login(Request $request)
    {
        $body = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $rsp = [
            'data' => Siswa::where('email', $body['email'])->where('password', $body['password'])->first()
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $siswa = Siswa::find($id);

        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'alamat' => $request->input('alamat'),
            'telp' => $request->input('telp'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $rsp = [
            'data' => $siswa->update($body)
        ];

        return $rsp;
    }

    public function addSaldo($id, Request $request)
    {
        $pengajar = Siswa::find($id);

        $currentSaldo = (int)$pengajar->saldo;
        $currentSaldo += (int)$request->saldo;

        $body = [
            'saldo' => $currentSaldo
        ];

        $rsp = [
            'data' => $pengajar->update($body)
        ];

        return $rsp;
    }

    public function minSaldo($id, Request $request)
    {
        $pengajar = Siswa::find($id);

        $currentSaldo = (int)$pengajar->saldo;
        $currentSaldo -= (int)$request->saldo;

        $body = [
            'saldo' => $currentSaldo
        ];

        $rsp = [
            'data' => $pengajar->update($body)
        ];

        return $rsp;
    }

    public function delete($id)
    {
        $pengajar = Siswa::find($id);
        $pengajar->delete();

        $rsp = [
            'data' => 204
        ];

        return $rsp;
    }
}
