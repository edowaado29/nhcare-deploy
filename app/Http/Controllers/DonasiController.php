<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Kedonaturan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Midtrans\Config;
use Midtrans\Snap;


class DonasiController extends Controller
{
    public function donasi(): View {
        $dnsi =  Donasi::paginate(5);
        return view('donasi.donasi', compact('dnsi'));
    }

    public function detail_donasi(string $id): view{
        $dnsi = Donasi::findOrFail($id);
        return View('donasi.detail_donasi', compact('dnsi'));
    }


    //api mobile
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),  // Pastikan order_id unik untuk setiap transaksi
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //add donasi
    public function handleNotification(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'order_id' => 'required|string',
            'nominal' => 'required|numeric',
            'tujuan' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'doa' => 'nullable|string',
            'id_donatur' => 'nullable|string',
            'transaction_time' => 'required|date',
        ]);

        // Simpan data transaksi ke tabel payments
        Donasi::create([
            'id_transaksi' => $validatedData['order_id'],
            'nominal' => $validatedData['nominal'],
            'tanggal_donasi' => $validatedData['transaction_time'],
            'tujuan' => $validatedData['tujuan'],
            'doa' => $validatedData['doa'],
            'id_donatur' => $validatedData['id_donatur'],
        ]);

        // Kembalikan respon sukses
        return response()->json(['message' => 'Transaction data received successfully'], 200);
    }

    //get alokasi
    public function alokasi()
    {
        $totalPembangunan = Donasi::where('tujuan', 'Pembangunan')->sum('nominal');
        $totalSantunan = Donasi::where('tujuan', 'Santunan')->sum('nominal');

        return response()->json([
            'totalPembangunan' => $totalPembangunan,
            'totalSantunan' => $totalSantunan
        ]);
    }

    //get Totaldonasi
    public function getTotalDonations()
    {
        $totalDonasi = Donasi::sum('nominal');

        return response()->json([
            'totalDonasi' => $totalDonasi,
        ]);
    }

    public function getDonationHistory(string $id_donatur)
    {
        $donations = Donasi::where('id_donatur', $id_donatur)
            ->select('nominal','tujuan', 'tanggal_donasi')
            ->get();

        return response()->json([
            'Donasi' => $donations,
        ]);
    }

}
