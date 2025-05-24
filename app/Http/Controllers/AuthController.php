<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token')->plainTextToken;
            return redirect()->route('index');
        } else {
            return back()->with('error_message', 'Email atau password salah!');
        }
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return redirect('/login')->with('success_message', 'Berhasil mendaftar!');
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('success_message', 'Berhasil logout!');
    }



}
