<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        // Encrypt password
        $validate['password'] = bcrypt($request->password);

        // Simpan data ke tabel users
        $user = User::create($validate);
        if($user){
            $data['success'] = true;
            $data['message'] = "User Berhasil di Registrasi";
            $data['data'] = $user->name;
            $data['token'] = $user->createToken('OlShop')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED);
        } else {
            $data['success'] = false;
            $data['message'] = "User Gagal di Registrasi";
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {
        if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        $user = Auth::user();
        $data['success'] = true;
        $data['message'] = 'Login berhasil';
        $data['token'] = $user->createToken('OlShop')->plainTextToken;
        $data['name'] = $user;
        return response()->json($data, Response::HTTP_OK);
    } else {
        $data['success'] = false;
        $data['message'] = 'Email atau password salah';
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    }
}
