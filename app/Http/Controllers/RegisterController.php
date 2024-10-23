<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 
    public function index()
    {
        return view('auth.register');
    }


    public function store(StoreRegisterRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        // initialize bag
        $user->bag()->create();

        return redirect('/login')->with(['success', 'Registrasi Berhasil'], $user);
    }
}
