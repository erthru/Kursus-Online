<?php

namespace App\Http\Controllers;

use App\MateriKuis;
use Illuminate\Http\Request;

class MateriKuisController extends Controller
{
    public function store(Request $request)
    {
        $body = [
            'pertanyaan' => $request->input('pertanyaan'),
            'jawaban' => $request->input('jawaban')
        ];

        $rsp = [
            'data' => MateriKuis::create($body)
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $materiKuis = MateriKuis::find($id);

        $body = [
            'pertanyaan' => $request->input('pertanyaan'),
            'jawaban' => $request->input('jawaban')
        ];

        $materiKuis->update($body);

        $rsp = [
            'data' => $materiKuis
        ];

        return $rsp;
    }
}
