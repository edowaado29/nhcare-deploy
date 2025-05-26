<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function artikel(): View
    {
        $artikels = Artikel::all();
        return view('layanan.artikel', compact('artikels'));
    }

    public function detail_artikel(string $id): View
    {
        $artikels = Artikel::findOrFail($id);
        return View('layanan.detail_artikel', compact('artikels'));
    }

    public function tambah_artikel(): View
    {
        return View('layanan.tambah_artikel');
    }

    public function tambah_artkl(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'judulArtikel' => 'required',
            'deskripsiArtikel' => 'required',
            'gambarArtikel' => 'image|mimes:jpeg,jpg,png|max:2048'
        ], 
        [
            'judulArtikel.required' => 'Judul artikel harus diisi!',
            'deskripsiArtikel.required' => 'Deskripsi artikel harus diisi!',
            'gambarArtikel.image' => 'Format gambar artikel salah!',
            'gambarArtikel.max' => 'Ukuran gambar artikel terlalu besar!'
        ]);

        $gambarArtikelPath = $request->hasFile('gambarArtikel') ? $request->file('gambarArtikel')->store('public/artikels') : null;
        $gambarArtikel = $gambarArtikelPath ? basename($gambarArtikelPath) : null;

        Artikel::create([
            'judulArtikel' => $request->judulArtikel,
            'deskripsiArtikel' => $request->deskripsiArtikel,
            'gambarArtikel' => $gambarArtikel
        ]); 
        return redirect()->route('artikel')->with(['message' => 'Artikel berhasil ditambahkan']);
    }

    public function edit_artikel(string $id): View
    {
        $artikels = Artikel::findOrFail($id);
        return view('layanan.edit_artikel', compact('artikels'));
    }

    public function update_artikel(Request $request, $id): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'judulArtikel' => 'required',
                'deskripsiArtikel' => 'required',
                'gambarArtikel' => 'image|mimes:jpeg,jpg,png|max:2048'
            ],
            [
                'judulArtikel.required' => 'Judul artikel harus diisi!',
                'deskripsiArtikel.required' => 'Deskripsi artikel harus diisi!',
                'gambarArtikel.image' => 'Format gambar artikel salah!',
                'gambarArtikel.max' => 'Ukuran gambar artikel terlalu besar!'
            ]
        );

        $artikels = artikel::findOrFail($id);

        if ($request->hasFile('gambarArtikel')) {
            $gambarArtikel = $request->file('gambarArtikel');
            $gambarArtikel->storeAs('public/artikels', $gambarArtikel->hashName());
            
            Storage::delete('public/artikels/' . $artikels->gambarArtikel);

            $artikels->update([
                'judulArtikel' => $request->judulArtikel,
                'deskripsiArtikel' => $request->deskripsiArtikel,
                'gambarArtikel' => $gambarArtikel->hashName()
            ]);
        } else {
            $artikels->update([
                'judulArtikel' => $request->judulArtikel,
                'deskripsiArtikel' => $request->deskripsiArtikel
            ]);
        }
        return redirect()->route('artikel')->with((['message' => 'Artikel Berhasil Diupdate']));
    }
    public function hapus_artikel($id): RedirectResponse
    {
        $artikels = artikel::findOrFail($id);

        storage::delete('public/artikels/' . $artikels->gambarArtikel);

        $artikels->delete();
        return redirect()->route('artikel')->with(['message' => 'Artikel berhasil dihapus']);
    }


    //controller untuk api di mobile
    public function artikels()
    {
        $artikel = Artikel::all();
        return response()->json($artikel);
    }
    public function latestArtikels()
{
    $latestArtikels = Artikel::orderBy('created_at', 'desc')->take(4)->get();
    return response()->json($latestArtikels);
}
}
