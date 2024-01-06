<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $matkuls = Matkul::all();
        return view('mahasiswa.create', compact('matkuls'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:20',
            'mahasiswa_name' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_tlp' => 'required',
            'matkul_id' => 'required',
        ]);

        $mahasiswas = mahasiswa::create([
            'nim' => $request->nim,
            'mahasiswa_name' => $request->mahasiswa_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlp' => $request->no_tlp,
            'matkul_id' => $request->matkul_id,
        ]);

        if ($mahasiswas) {
            return redirect()
                ->route('mahasiswa.index')
                ->with([
                    'success' => 'Data Mahasiswa Berhasil ditambahkan'
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

    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    public function edit($id)
    {
        $matkuls = Matkul::all();
        $mahasiswas = mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswas', 'matkuls'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:20',
            'mahasiswa_name' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_tlp' => 'required',
            'matkul_id' => 'required',
        ]);

        $mahasiswas = mahasiswa::findOrFail($id);

        $mahasiswas->update([
            'nim' => $request->nim,
            'mahasiswa_name' => $request->mahasiswa_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlp' => $request->no_tlp,
            'matkul_id' => $request->matkul_id,
        ]);

        if ($mahasiswas) {
            return redirect()
                ->route('mahasiswa.index')
                ->with([
                    'success' => 'Data Mahasiswa Berhasil diperbaharui'
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
        $mahasiswas = mahasiswa::findOrFail($id);
        $mahasiswas->delete();

        if ($mahasiswas) {
            return redirect()
                ->route('mahasiswa.index')
                ->with([
                    'success' => 'Data Mahasiswa Berhasil dihapuskan'
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
