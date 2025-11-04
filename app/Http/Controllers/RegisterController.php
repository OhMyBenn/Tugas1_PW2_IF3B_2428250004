<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
            'c_password'    => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json([
                'succsess'  => false,
                'message'   => 'Validasi Gagal.',
                'data'      =>$validator->errors()
            ], 400);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            // Simpan data user ke database
            $user = User::create($input);
            // Generate token ==> simpan data ke tabel personal_access_tokens
            $success['token'] = $user->createToken('OlShop')->plainTextToken;
            // Ambil nama user
            $success['user'] = $user->name;
            // return $this->sendResponse($success, 'User berhasil didaftarkan.');
            return response()->json([
                'success'   => true,
                'message'   => 'User berhasil didaftarkan.',
                'data'      => $success
            ], 200);
        }
    }

    public function login(Request $request)
    {
        // Jika email dan password terdaftar di tabel users
        if (Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ])) {
            $user = Auth::user();
            // Generate token, simpan ke tabel personal access tokens
            $success['token'] = $user->createToken('OlShop')->plainTextToken;
            $success['user'] = $user->name;
            // return $this->sendResponse($success, 'Login Berhasil.');
            return response()->json([
                'success'   => true,
                'message'   => 'Login Berhasil.',
                'data'      => $success
            ], 200);
        } else {
            // email atau password salah
            // return $this->sendError('Login gagal.', ['error' => 'Email atau Password salah']);
            return response()->json([
                'success'   => false,
                'message'   => 'Login gagal',
                'data'      => ['error' => 'Email atau Password salah']
            ], 401);
        }
    }
}