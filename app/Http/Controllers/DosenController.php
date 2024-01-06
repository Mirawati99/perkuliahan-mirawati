<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\Prodi;
use App\Models\Matkul;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = dosen::latest()->get();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        $matkuls = Matkul::all();
        $prodis = Prodi::all();
        return view('dosen.create',compact('matkuls','prodis'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'dosen_name' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_tlp' => 'required',
            'matkul_id' => 'required',
            'prodi_id' => 'required',
        ]);

        $dosens = dosen::create([
            'nip' => $request->nip,
            'dosen_name' => $request->dosen_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlp' => $request->no_tlp,
            'matkul_id' => $request->matkul_id,
            'prodi_id' => $request->prodi_id,
        ]);

        if ($dosens) {
            return redirect()
                ->route('dosen.index')
                ->with([
                    'success' => 'Data Dosen Berhasil ditambahkan'
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

    public function show(dosen $dosen)
    {
        //
    }

    public function edit($id)
    {
        $matkuls = Matkul::all();
        $prodis = Prodi::all();
        $dosens = dosen::findOrFail($id);
        return view('dosen.edit', compact('dosens','matkuls','prodis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'nip' => 'required|string|max:20',
            'dosen_name' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_tlp' => 'required',
            'matkul_id' => 'required',
            'prodi_id' => 'required',
        ]);

        $dosens = dosen::findOrFail($id);

        $dosens->update([
            'nip' => $request->nip,
            'dosen_name' => $request->dosen_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlp' => $request->no_tlp,
            'matkul_id' => $request->matkul_id,
            'prodi_id' => $request->prodi_id,
        ]);

        if ($dosens) {
            return redirect()
                ->route('dosen.index')
                ->with([
                    'success' => 'Data Dosen Berhasil diperbaharui'
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
        $dosens = dosen::findOrFail($id);
        $dosens->delete();

        if ($dosens) {
            return redirect()
                ->route('dosen.index')
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
