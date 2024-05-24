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
    public function show($id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);
        return view('pengepul.user-profile', ['pengepul' => $pengepul]);
    }

    public function update(Request $request, $id_pengepul)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id_pengepul, 'id_pengepul'),
            ],
            'alamat' => ['nullable', 'max:100'],
            'username' => ['nullable', 'max:20'],
            'no_hp' => ['nullable', 'max:15'],
            'no_rek' => ['nullable', 'numeric'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $pengepul = User::findOrFail($id_pengepul);

        // Log before update
        Log::info('Updating user:', ['attributes' => $attributes]);

        // Update pengepul data except foto_profil
        $pengepul->update($request->except('foto_profil'));

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            if ($pengepul->foto_profil) {
                Storage::delete('foto_profil/' . $pengepul->foto_profil);
            }

            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
            $pengepul->foto_profil = $newName;
        }

        // Save changes
        $pengepul->save();

        // Log after update
        Log::info('Updated user:', ['pengepul' => $pengepul->toArray()]);

        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');
        return back()->with('success', 'Profile successfully updated');
    }
}
