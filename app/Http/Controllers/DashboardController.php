<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Anakasuh;
use App\Models\Donasi;
use App\Models\Kedonaturan;
use App\Models\Pengasuh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $sum_donasi = Donasi::sum('nominal');
        $count_pengasuh = Pengasuh::count();
        $count_anakasuh = Anakasuh::count();
        $count_donatur = Kedonaturan::count();
        $today = Carbon::today();
        $acra = Acara::whereDate('tanggalAcara', $today)->get();
        return view('dashboard.dashboard', compact('sum_donasi', 'count_pengasuh', 'count_anakasuh', 'count_donatur', 'acra'));
    }
}
