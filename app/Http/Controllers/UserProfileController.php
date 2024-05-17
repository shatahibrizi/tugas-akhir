<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pengepul.user-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id_pengepul),],
            'alamat' => ['max:100'],
            'username' => ['max:20'],
            'no_hp' => ['max:11', 'numeric'],
            'no_rek' => ['max:11', 'numeric'],
            'foto_profil' => ['required|image|mimes:jpeg,png,jpg,gif|max:2048'],
        ]);

        dd($attributes);

        auth()->user()->update([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'alamat' => $request->get('alamat'),
            'username' => $request->get('username'),
            'no_hp' => $request->get('no_hp'),
            'no_rek' => $request->get('no_rek'),
            'foto_profil' => $request->get('country'),
        ]);
        return back()->with('succes', 'Profile succesfully updated');
    }
}
