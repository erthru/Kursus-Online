<?php

namespace App\Http\Controllers;

use App\MateriMateri;
use Illuminate\Http\Request;

class MateriMateriController extends Controller
{
    public function store(Request $request)
    {
        $body = [
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'materi_id' => $request->input('materi_id')
        ];

        $rsp = [
            'data' => MateriMateri::create($body)
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $materiMateri = MateriMateri::find($id);

        $body = [
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'materi_id' => $request->input('materi_id')
        ];

        $materiMateri->update($body);

        $rsp = [
            'data' => $materiMateri
        ];

        return $rsp;
    }
}
