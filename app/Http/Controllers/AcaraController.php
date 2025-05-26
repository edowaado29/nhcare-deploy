<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AcaraController extends Controller
{
    public function acara(): View
    {
        $acra = Acara::all();
        return view('layanan.acara', compact('acra'));
    }

    public function detail_acara(string $id): view
    {
        $acra = Acara::findOrFail($id);

        return view('layanan.detail_acara', compact('acra'));
    }

    public function tambah_acara(): View
    {
        return view('layanan.tambah_acara');
    }

    public function tambahAcr(Request $request): RedirectResponse
    {   
        $this->validate($request, [
            'namaAcara' => 'required',
            'deskripsiAcara' => 'required',
            'tanggalAcara' => 'required',
            'gambarAcara' => 'image|mimes:jpeg,jpg,png|max:2048'
        ], 
        [
            'namaAcara.required' => 'Nama acara harus diisi!',
            'deskripsiAcara.required' => 'Deskripsi acara harus diisi!',
            'tanggalAcara.required' => 'Tanggal acara harus diisi!',
            'gambarAcara.image' => 'Format gambar acara salah',
            'gambarAcara.max' => 'Ukuran gambar acara terlalu besar'
        ]);
        
        $gambarAcaraPath = $request->hasFile('gambarAcara') ? $request->file('gambarAcara')->store('public/acaras') : null;
        $gambarAcara = $gambarAcaraPath ? basename($gambarAcaraPath) : null;

        Acara::create([
            'namaAcara' => $request->namaAcara,
            'deskripsiAcara' => $request->deskripsiAcara,
            'tanggalAcara' => $request->tanggalAcara,
            'gambarAcara' => $gambarAcara
        ]);
        return redirect()->route('acara')->with(['message' => 'Acara berhasil ditambahkan']);
    }

    public function edit_acara(string $id): View
    {
        $acra = Acara::findOrFail($id);

        return view('layanan.edit_acara', compact('acra'));
    }

    public function updateAcr(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'namaAcara' => 'required',
            'deskripsiAcara' => 'required',
            'tanggalAcara' => 'required',
            'gambarAcara' => 'image|mimes:jpeg,jpg,png|max:2048'
        ],
        [
            'namaAcara.required' => 'Nama Acara harus diisi!',
            'deskripsiAcara.required' => 'Deskripsi Acara harus diisi!',
            'tanggalAcara.required' => 'Tanggal Acara harus diisi!',
            'gambarAcara.image' => 'Format gambar acara salah',
            'gambarAcara.max' => 'Ukuran gambar acara terlalu besar'
        ]);

        $acra = acara::findOrFail($id);

        if ($request->hasFile('gambarAcara')) {
            $gambarAcara = $request->file('gambarAcara');
            $gambarAcara->storeAs('public/acaras', $gambarAcara->hashName());

            Storage::delete('public/acaras/' . $acra->gambarAcara);

            $acra->update([
                'namaAcara' => $request->namaAcara,
                'deskripsiAcara' => $request->deskripsiAcara,
                'tanggalAcara' => $request->tanggalAcara,
                'gambarAcara' => $gambarAcara->hashName()
            ]);
        } else {
            $acra->update([
                'namaAcara' => $request->namaAcara,
                'deskripsiAcara' => $request->deskripsiAcara,
                'tanggalAcara' => $request->tanggalAcara
            ]);
        }
        return redirect()->route('acara')->with((['message' => 'Acara berhasil diedit']));
    }

    public function hapus_acara($id): RedirectResponse
    {
        $acra = acara::findOrFail($id);

        Storage::delete('public/acaras/' . $acra->gambarAcara);

        $acra->delete();
        return redirect()->route('acara')->with(['message' => 'Acara berhasil dihapus']);
    }


    //untuk api di mobile
    public function acaras()
    {
        $acara = Acara::all();
        return response()->json($acara);
    }

}
