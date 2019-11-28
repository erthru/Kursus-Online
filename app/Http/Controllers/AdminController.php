<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $body = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role')
        ];

        $rsp = [
            'data' => Admin::create($body)
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
