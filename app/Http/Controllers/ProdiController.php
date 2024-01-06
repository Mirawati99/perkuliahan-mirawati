<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::latest()->get();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prodi_name' => 'required|string|max:20',
        ]);

        $prodis = Prodi::create([
            'prodi_name' => $request->prodi_name,
        ]);

        if ($prodis) {
            return redirect()
                ->route('prodi.index')
                ->with([
                    'success' => 'Data Prodi Berhasil ditambahkan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }
    }

    public function show(Prodi $prodi)
    {
        //
    }

    public function edit($id)
    {
        $prodis = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'prodi_name' => 'required|string|max:20',
        ]);

        $prodis = Prodi::findOrFail($id);

        $prodis->update([
            'prodi_name' => $request->prodi_name,
        ]);

        if ($prodis) {
            return redirect()
                ->route('prodi.index')
                ->with([
                    'success' => 'Data Prodi Berhasil diperbaharui'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }
    }

    public function destroy($id)
    {
        $prodis = Prodi::findOrFail($id);
        $prodis->delete();

        if ($prodis) {
            return redirect()
                ->route('prodi.index')
                ->with([
                    'success' => 'Data Prodi Berhasil dihapuskan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }
    }
}
