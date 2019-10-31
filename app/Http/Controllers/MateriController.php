<?php

namespace App\Http\Controllers;

use App\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($id)
    {
        $rsp = [
            'data' => Materi::with(['kelas','materi','kuis'])->find($id)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'tipe' => $request->input('tipe'),
            'kelas_id' => $request->input('kelas_id')
        ];

        $rsp = [
            'data' => Materi::create($body)
        ];

        return $rsp;
    }

    public function delete($id)
    {
        $materi = Materi::find($id);
        $materi->delete();

        $rsp = [
            'data' => 204
        ];

        return $rsp;
    }
}
