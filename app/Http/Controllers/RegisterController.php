<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        // return $request;
       $validatedData = $request->validate([
           'nomor_telepon' => ['required', 'min:10', 'max:13', 'unique:users'],
            'nama_lengkap' => 'required',
            'password' => 'required|min:5|max:255',
            'nama_perusahaan' => 'required',
       ]);

       $validatedData['password'] = Hash::make($validatedData['password']);

       User::create($validatedData);

       return redirect('/login')->with('success', 'Registrasi Berhasil! Silahkan Masuk ke Akun Anda!');
    }
}
