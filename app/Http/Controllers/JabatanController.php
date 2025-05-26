<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pengasuh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JabatanController extends Controller
{
    public function jabatan(): View
    {
        $jabatan = Jabatan::all();
        return view('kepengasuhan.jabatan', compact('jabatan'));
    }

    public function tambah_jabatan(): View
    {
        return view('kepengasuhan.tambah_jabatan');
    }

    public function tambahJabat(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
        ]);
        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan
        ]);
        return redirect()->route('jabatan')->with(['message' => 'Jabatan berhasil ditambahkan']);
    }

    public function edit_jabatan(string $id): View
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('kepengasuhan.edit_jabatan', compact('jabatan'));
    }

    public function update_jabatan(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_jabatan' => 'required'
        ]);
        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);
        return redirect()->route('jabatan')->with(['message' => 'Jabatan berhasil diedit']);
    }

    public function hapus_jabatan($id): RedirectResponse
    {
        $jabatan = Jabatan::findOrFail($id);
        $pengasuh = Pengasuh::where('id_jabatan', $id)->get();
        if($pengasuh->isNotEmpty()){
            foreach ($pengasuh as $p) {
                $p->delete();
            }
        }
        $jabatan->delete();
        return redirect()->route('jabatan')->with(['message' => 'Jabatan berhasil dihapus']);
    }
}
