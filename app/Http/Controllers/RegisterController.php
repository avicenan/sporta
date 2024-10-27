<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\Bag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();
        try {

            $bag = new Bag();
            $bag->save();

            $user = new User($validatedData);
            $user['role_id'] = 2;
            $user['bag_id'] = $bag->id;
            $user->save();

            DB::commit();

            return redirect('/login')->with(['success', 'Registrasi Berhasil'], $user);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi'
            ]);
        }
    }
}
