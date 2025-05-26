<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pengasuh;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengasuhController extends Controller
{
    public function pengasuh(): View
    {
        $peng = Pengasuh::all();

        return view('kepengasuhan.pengasuh', compact('peng'));
    }

    public function tambah_pengasuh(): View
    {
        $jabatans = Jabatan::all();
        return view('kepengasuhan.tambah_pengasuh', compact('jabatans'));
    }

    public function tambahPeng(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_pengasuh' => 'required',
            'id_jabatan' => 'required',
            'email' => 'required|email',
            'foto_kartukeluarga' => 'image|mimes:jpeg,jpg,png|max:2048',
            'foto_ktp' => 'image|mimes:jpeg,jpg,png|max:2048',
            'foto_pengasuh' => 'image|mimes:jpeg,jpg,png|max:2048'
        ],
    [
        'nama_pengasuh.required' => 'Nama pengasuh harus diisi!',
        'id_jabatan.required' => 'Jabatan pengasuh harus diisi!',
        'email.required' => 'Email harus diisi!',
        'email.email' => 'Email tidak valid',
        'foto_kartukeluarga.image' => 'Format foto KK salah',
        'foto_kartukeluarga.max' => 'Ukuran foto KK terlalu besar',
        'foto_ktp.image' => 'Format foto KTP salah',
        'foto_ktp.max' => 'Ukuran foto KTP terlalu besar',
        'foto_pengasuh.image' => 'Format foto Pengasuh salah',
        'foto_pengasuh.max' => 'Ukuran foto Pengasuh terlalu besar',
    ]);

        $fotoKKPath = $request->hasFile('foto_kartukeluarga') ? $request->file('foto_kartukeluarga')->store('public/pengasuhs/KK') : null;
        $fotoKTPPath = $request->hasFile('foto_ktp') ? $request->file('foto_ktp')->store('public/pengasuhs/KTP') : null;
        $fotoPath = $request->hasFile('foto_pengasuh') ? $request->file('foto_pengasuh')->store('public/pengasuhs/foto') : null;

        $fotokk = $fotoKKPath ? basename($fotoKKPath) : null;
        $fotoktp = $fotoKTPPath ? basename($fotoKTPPath) : null;
        $foto = $fotoPath ? basename($fotoPath) : null;

        $getEmail = Pengasuh::where('email', '=', $request->email)->first();

        $currentDateTime = Carbon::now()->format('YmdHisu');
        $id_pengasuh = "P-". $currentDateTime;

        if($getEmail){
            return back()->with('fail', 'Email sudah terdaftar!');
        } else{
            Pengasuh::create([
                'id' => $id_pengasuh,
                'nbm' => $request->input('nbm'),
                'nama_pengasuh' => $request->input('nama_pengasuh'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'id_jabatan' => $request->input('id_jabatan'),
                'alamat' => $request->input('alamat'),
                'nomor_handphone' => $request->input('nomor_handphone'),
                'email' => $request->input('email'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
                'status_pengasuh' => 'Aktif',
                'foto_kartukeluarga' => $fotokk,
                'foto_ktp' => $fotoktp,
                'foto_pengasuh' => $foto,
            ]);
            return redirect()->route('pengasuh')->with('message', 'Pengasuh berhasil ditambahkan');
        }
    }


    public function detail_pengasuh(string $id): View
    {
        $peng = Pengasuh::findOrFail($id);
        return view('kepengasuhan.detail_pengasuh', compact('peng'));
    }

    public function edit_pengasuh(string $id): view
    {
        $peng = Pengasuh::findOrFail($id);
        $jabatans = Jabatan::all();
        return view('kepengasuhan.edit_pengasuh', compact('peng', 'jabatans'));
    }

    public function update_pengasuh(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_pengasuh' => 'required',
            'email' => 'email',
            'foto_kartukeluarga' => 'image|mimes:jpeg,jpg,png|max:2048',
            'foto_ktp' => 'image|mimes:jpeg,jpg,png|max:2048',
            'foto_pengasuh' => 'image|mimes:jpeg,jpg,png|max:2048'
        ],
        [
            'nama_pengasuh.required' => 'Nama pengasuh harus diisi!',
            'id_jabatan.required' => 'Jabatan pengasuh harus diisi!',
            'email.email' => 'Email tidak valid',
            'foto_kartukeluarga.image' => 'Format foto KK salah',
            'foto_kartukeluarga.max' => 'Ukuran foto KK terlalu besar',
            'foto_ktp.image' => 'Format foto KTP salah',
            'foto_ktp.max' => 'Ukuran foto KTP terlalu besar',
            'foto_pengasuh.image' => 'Format foto Pengasuh salah',
            'foto_pengasuh.max' => 'Ukuran foto Pengasuh terlalu besar',
        ]);

        $peng = Pengasuh::findOrFail($id);

        if ($request->hasFile('foto_kartukeluarga')) {
            $fotoKKPath = $request->file('foto_kartukeluarga')->store('public/pengasuhs/KK');
            if ($peng->foto_kartukeluarga && Storage::exists('public/pengasuhs/KK/' . $peng->foto_kartukeluarga)) {
                Storage::delete('public/pengasuhs/KK/' . $peng->foto_kartukeluarga);
            }
            $peng->foto_kartukeluarga = basename($fotoKKPath);
        }

        if ($request->hasFile('foto_ktp')) {
            $fotoKTPPath = $request->file('foto_ktp')->store('public/pengasuhs/KTP');
            if ($peng->foto_ktp && Storage::exists('public/pengasuhs/KTP/' . $peng->foto_ktp)) {
                Storage::delete('public/pengasuhs/KTP/' . $peng->foto_ktp);
            }
            $peng->foto_ktp = basename($fotoKTPPath);
        }

        if ($request->hasFile('foto_pengasuh')) {
            $fotoPath = $request->file('foto_pengasuh')->store('public/pengasuhs/foto');
            if ($peng->foto_pengasuh && Storage::exists('public/pengasuhs/foto/' . $peng->foto_pengasuh)) {
                Storage::delete('public/pengasuhs/foto/' . $peng->foto_pengasuh);
            }
            $peng->foto_pengasuh = basename($fotoPath);
        }

        if(Pengasuh::where('email', '=', $request->email)->where('id', '!=', $request->id)->first()){
            return back()->with('fail', 'Email sudah terdaftar!');
        } else if(Pengasuh::where('email', '=', $request->email)->where('id', '=', $request->id)->first() || Pengasuh::where('email', '!=', $request->email)->where('id', '=', $request->id)->first()){
            $peng->update([
                'nbm' => $request->input('nbm'),
                'nama_pengasuh' => $request->input('nama_pengasuh'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'id_jabatan' => $request->input('id_jabatan'),
                'alamat' => $request->input('alamat'),
                'nomor_handphone' => $request->input('nomor_handphone'),
                'email' => $request->input('email'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
                'status_pengasuh' => $request->input('status_pengasuh'),
                'foto_kartukeluarga' => $peng->foto_kartukeluarga,
                'foto_ktp' => $peng->foto_ktp,
                'foto_pengasuh' => $peng->foto_pengasuh
            ]);
        }

        return redirect()->route('pengasuh')->with('message', 'Data pengasuh berhasil diedit');
    }

    public function hapus_pengasuh($id): RedirectResponse
    {
        $peng = Pengasuh::findOrFail($id);

        Storage::delete('public/pengasuhs/KK/' . $peng->foto_kartukeluarga);
        Storage::delete('public/pengasuhs/KTP/' . $peng->foto_ktp);
        Storage::delete('public/pengasuhs/foto/' . $peng->foto_pengasuh);

        $peng->delete();

        return redirect()->route('pengasuh')->with(['message' => 'Pengasuh berhasil dihapus']);
    }
}
