<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show($id)
    {
        $rsp = [
            'data' => Admin::find($id)
        ];

        return $rsp;
    }

    public function store(Request $request)
    {
        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role')
        ];

        $rsp = [
            'data' => Admin::create($body)
        ];

        return $rsp;
    }

    public function update($id, Request $request)
    {
        $admin = Admin::find($id);

        $body = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role')
        ];

        $admin->update($body);

        $rsp = [
            'data' => $admin
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
            'data' => Admin::where('email', $body['email'])->where('password', $body['password'])->first()
        ];

        return $rsp;
    }
}
