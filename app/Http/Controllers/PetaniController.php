<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Product;
use App\Models\PetaniLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    function index()
    {
        // Mengambil id_pengepul dari user yang saat ini masuk
        $id_pengepul = auth()->user()->id_pengepul;
        // dd($id_pengepul);

        $petani = Petani::paginate(5);

        // Kirim data ke view
        return view('pengepul.petani.petani', ['petani' => $petani]);
    }

    function show($id_petani)
    {
        $petani = Petani::with('products')->findOrFail($id_petani);
        return view('pengepul.petani.petani-detail', ['petani' => $petani]);
    }

    function create()
    {
        $petani = Petani::all();

        return view('pengepul.petani.petani-add', ['petani' => $petani]);
    }

    public function store(Request $request)
    {
        $newName = '';

        if ($request->file('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
        }
        if (!empty($newName)) {
            $request['foto'] = $newName;
        }
        $request['foto'] = $newName;

        $petani = Petani::create([
            'nama' => $request->nama,
            'foto' => $newName,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'luas_lahan' => $request->luas_lahan,
            'lokasi_lahan' => $request->lokasi_lahan,
            'grup_petani' => $request->grup_petani,
        ]);

        // Log the action
        PetaniLog::create([
            'id_pengepul' => auth()->user()->id_pengepul,
            'id_petani' => $petani->id_petani,
            'action' => 'create',
            'changes' => json_encode($petani->toArray()),
        ]);

        if ($petani) {
            session()->flash('status', 'success');
            session()->flash('message', 'add data success!');
        }
        return redirect('/stok/petani');
    }

    public function edit(Request $request, $id_petani)
    {
        $petani = Petani::findOrFail($id_petani);
        // dd($petani);
        return view('pengepul.petani.petani-edit', ['petani' => $petani]);
    }



    public function update(Request $request, $id_petani)
    {
        $petani = Petani::findOrFail($id_petani);

        // Filter out unwanted keys
        $filteredRequest = $request->except(['_token', '_method', 'action']);

        $changes = [];
        foreach ($filteredRequest as $key => $value) {
            $oldValue = html_entity_decode($petani->$key);
            $newValue = html_entity_decode($value);
            if ($oldValue != $newValue) {
                $changes[$key] = ['old' => $oldValue, 'new' => $newValue];
            }
        }

        $petani->update($filteredRequest);

        if ($request->hasFile('foto')) {
            if ($petani->foto) {
                Storage::delete('foto/' . $petani->foto);
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
            $petani->foto = $newName;
        }

        $petani->save();

        PetaniLog::create([
            'id_pengepul' => auth()->user()->id_pengepul,
            'id_petani' => $petani->id_petani,
            'action' => 'update',
            'changes' => json_encode($changes),
        ]);

        session()->flash('status', 'success');
        session()->flash('message', 'edit data success!');

        return redirect('/stok/petani');
    }

    public function destroy(Request $request, $id_petani)
    {
        $deletedPetani = Petani::findOrFail($id_petani);
        $deletedPetaniData = $deletedPetani->toArray();
        $deletedPetani->delete();

        // Log the action
        PetaniLog::create([
            'id_pengepul' => auth()->user()->id_pengepul,
            'id_petani' => $deletedPetani->id_petani,
            'action' => 'delete',
            'changes' => json_encode($deletedPetaniData),
        ]);

        if ($deletedPetani) {
            session()->flash('status', 'success');
            session()->flash('message', 'delete ' . $deletedPetani->nama . ' success!');
        }
        return redirect('/stok/petani');
    }

    public function showLogs()
    {
        $logs = PetaniLog::with(['pengepul', 'petani'])->orderBy('created_at', 'desc')->get();

        return view('pengepul.petani.petani-logs', compact('logs'));
    }
}
