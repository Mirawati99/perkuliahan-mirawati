<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::latest()->get();
        return view('matkul.index', compact('matkuls'));
    }

    public function create()
    {
        return view('matkul.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'matkul_name' => 'required|string|max:20',
        ]);

        $matkuls = Matkul::create([
            'matkul_name' => $request->matkul_name,
        ]);

        if ($matkuls) {
            return redirect()
                ->route('matkul.index')
                ->with([
                    'success' => 'Data Mata Kuliah Berhasil ditambahkan'
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

    public function show(Matkul $matkul)
    {
        //
    }

    public function edit($id)
    {
        $matkuls = Matkul::findOrFail($id);
        return view('matkul.edit', compact('matkuls'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'matkul_name' => 'required|string|max:20',
        ]);

        $matkuls = Matkul::findOrFail($id);

        $matkuls->update([
            'matkul_name' => $request->matkul_name,
        ]);

        if ($matkuls) {
            return redirect()
                ->route('matkul.index')
                ->with([
                    'success' => 'Data Mata Kuliah Berhasil diperbaharui'
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
        $matkuls = Matkul::findOrFail($id);
        $matkuls->delete();

        if ($matkuls) {
            return redirect()
                ->route('matkul.index')
                ->with([
                    'success' => 'Data Mata Kuliah Berhasil dihapuskan'
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
