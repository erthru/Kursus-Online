<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($id)
    {
        $rsp = [
            'data' => Materi::with(['kelas'])->find($id)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'kelas_id' => $request->input('kelas_id')
        ];

        $rsp = [
            'data' => Materi::create($body)
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $materi = Materi::find($id);

        $body = [
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'kelas_id' => $request->input('kelas_id')
        ];

        $rsp = [
            'data' => $materi->update($body)
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
