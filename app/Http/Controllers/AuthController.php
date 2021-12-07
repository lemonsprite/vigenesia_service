<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens as APIToken;


class AuthController extends Controller
{
    public function register(Request $req)
    {
        $param = $req->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'nama' => $param['nama'],
            'email' => $param['email'],
            'password' => Hash::make($param['password'])
        ]);

        $token = $user->createToken('vigenesiaTWS')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token,
        ];

        return response($res, 201);
    }

    public function login(Request $req)
    {
        // Validasi parameter request
        $param = $req->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Cari data berdasar email
        $user = User::where('email', $param['email'])->first();

        // Cek parameter password dengan database dan data user dalam database
        if(!$user || !Hash::check($param['password'], $user->password))
        {
            // Respon API jika data tidak ditemukan dan password salah
            $res = [
                'message' => 'Akun tidak valid.'
            ];
            return response($res, 401);
        }

        // Generate token user untuk autentikasi
        $token = $user->createToken('vigenesiaTWS')->plainTextToken;

        // Return respon API jika sukses
        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201);
    }

    public function logout(Request $req)
    {
        // Ambil data kredensial saat ini lalu hapus token.
        auth()->user()->tokens()->delete();
        return response(['message' => 'Anda berhasil keluar.']);
    }
}
