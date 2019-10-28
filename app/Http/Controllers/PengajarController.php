<?php

namespace App\Http\Controllers;

use App\Pengajar;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    public function all()
    {
        $rsp = [
            'data' => Pengajar::orderBy('id', 'DESC')->paginate(15)
        ];

        return $rsp;
    }

    public function show($id)
    {
        $kelasTotal = 0;

        $rsp = [
            'data' => Pengajar::with([
                'kelas' => function ($kelas) use (&$kelasTotal) {
                    $kelas->orderBy('id', 'DESC')->paginate(15);
                    $kelasTotal = $kelas->count();
                }
            ])->find($id),
            'has_many_count' => [
                'kelas' => $kelasTotal
            ]
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'telp' => $request->input('telp'),
            'saldo' => 0,
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $rsp = [
            'data' => Pengajar::create($body)
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
            'data' => Pengajar::where('email', $body['email'])->where('password', $body['password'])->first()
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $pengajar = Pengajar::find($id);

        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'telp' => $request->input('telp'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $pengajar->update($body);

        $rsp = [
            'data' => $pengajar
        ];

        return $rsp;
    }

    public function addSaldo($id, Request $request)
    {
        $pengajar = Pengajar::find($id);

        $currentSaldo = (int)$pengajar->saldo;
        $currentSaldo += (int)$request->saldo;

        $body = [
            'saldo' => $currentSaldo
        ];

        $pengajar->update($body);

        $rsp = [
            'data' => $pengajar
        ];

        return $rsp;
    }

    public function minSaldo($id, Request $request)
    {
        $pengajar = Pengajar::find($id);

        $currentSaldo = (int)$pengajar->saldo;
        
        if ($currentSaldo != 0){
            $currentSaldo -= (int)$request->saldo;
        }

        $body = [
            'saldo' => $currentSaldo
        ];

        $pengajar->update($body);

        $rsp = [
            'data' => $pengajar
        ];

        return $rsp;
    }

    public function delete($id)
    {
        $pengajar = Pengajar::find($id);
        $pengajar->delete();

        $rsp = [
            'data' => 204
        ];

        return $rsp;
    }
}
