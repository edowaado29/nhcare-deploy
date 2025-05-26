<?php

namespace App\Http\Controllers;

use App\Models\Anakasuh;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SeleksiController extends Controller
{
    public function seleksi(): View
    {
        return view('asuhan.seleksi');
    }
    
    public function hasilSeleksi(): View
    {
        $anak_terpilih = Session::get('anak_asuh');
        return view('asuhan.hasil_seleksi', compact('anak_terpilih'));
    }

    public function seleksiAnakasuh(Request $request)
    {
        $this->validate($request, [
            'jumlah_anak' => 'required'
        ],
        [
            'jumlah_anak.required' => 'Jumlah anak harus diisi!'
        ]);

        $bobot_keterangan = [
            "Yatim Piatu" => 120,
            "Yatim" => 110,
            "Piatu" => 100,
            "Dhuafa" => 90
        ];

        $bobot_kelas = [
            "TK Kecil" => 80,
            "TK Besar" => 75,
            "1" => 70, 
            "2" => 65, 
            "3" => 60, 
            "4" => 55,  
            "5" => 50,  
            "6" => 45,  
            "7" => 40,  
            "8" => 35,  
            "9" => 30,  
            "10" => 25,  
            "11" => 20,  
            "12" => 15  
        ];

        $bobot_prestasi = 10;

        $anak_asuh = Anakasuh::with('prestasi')->get()->map(function ($anak) use ($bobot_keterangan, $bobot_kelas, $bobot_prestasi) {
            $nilai_kelas = $bobot_kelas[$anak->kelas];
            $nilai_keterangan = $bobot_keterangan[$anak->keterangan];

            $jumlah_prestasi = $anak->prestasi->count();
            $nilai_prestasi = $jumlah_prestasi * $bobot_prestasi;

            $skor_total = (($nilai_keterangan + $nilai_kelas) / 2) + $nilai_prestasi;

            $anak->jumlah_prestasi = $jumlah_prestasi;
            $anak->skor_total = $skor_total;

            return $anak;
        });

        $jumlah_anak = $request->jumlah_anak;

        $request->session()->put('anak_asuh', $anak_asuh->sortByDesc('skor_total')->take($jumlah_anak));

        // return view('asuhan.hasil_seleksi', ['anak_terpilih' => $anak_asuh]);
        return redirect()->route('hasilSeleksi');
    }
}
