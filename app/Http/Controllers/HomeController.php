<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pemasukan;
use App\Models\Pengaduan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::latest()->paginate(6);
        $beritas = Berita::latest()->take(3)->get();

        return view('home', compact('pengaduans', 'beritas'));
    }

    public function dashboard()
    {
        $currentYear = Carbon::now()->year;
        $totalPemasukan = Pemasukan::whereYear('tanggal_pemasukan', $currentYear)
            ->where('status', 'disetujui')
            ->sum('jumlah_pemasukan');
        $totalPengeluaran = Pengeluaran::whereYear('tanggal_pengeluaran', $currentYear)
            ->where('status', 'disetujui')
            ->sum('jumlah_pengeluaran');
        $sisaDana = $totalPemasukan - $totalPengeluaran;

        $pemasukanData = Pemasukan::selectRaw('MONTH(tanggal_pemasukan) AS bulan, SUM(jumlah_pemasukan) AS total_pemasukan')
            ->whereYear('tanggal_pemasukan', $currentYear)
            ->where('status', 'disetujui')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total_pemasukan', 'bulan')
            ->toArray();


        $pengeluaranData = Pengeluaran::selectRaw('MONTH(tanggal_pengeluaran) AS bulan, SUM(jumlah_pengeluaran) AS total_pengeluaran')
            ->whereYear('tanggal_pengeluaran', $currentYear)
            ->where('status', 'disetujui')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total_pengeluaran', 'bulan')
            ->toArray();

        $bulan = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'Mei',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Ags',
            '9' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des'
        ];

        $pemasukanChart = [];
        $pengeluaranChart = [];

        foreach ($bulan as $key => $value) {
            $pemasukanChart[] = $pemasukanData[$key] ?? 0;
            $pengeluaranChart[] = $pengeluaranData[$key] ?? 0;
        }


        return view('app.dashboard', compact('totalPemasukan', 'totalPengeluaran', 'sisaDana', 'pemasukanChart', 'pengeluaranChart', 'bulan', 'bulan'));
    }

    public function indexBerita()
    {
        $beritas = Berita::latest()->paginate(5);
        return view('index-berita', compact('beritas'));
    }
    public function detailBerita(string $id)
    {
        $berita = Berita::findOrFail($id);

        return view('detail-berita', compact('berita'));
    }

    public function indexPemasukan(Request $request)
    {
        $dariTanggal = $request->dari_tanggal;
        $sampaiTanggal = $request->sampai_tanggal;

        $query = Pemasukan::where('status', 'disetujui');

        if ($dariTanggal && $sampaiTanggal) {
            $query->whereBetween('tanggal_pemasukan', [$dariTanggal, $sampaiTanggal]);
        }

        $pemasukans = $query->paginate(10);
        $totalPemasukan = $query->sum('jumlah_pemasukan');

        return view('index-pemasukan', compact('pemasukans', 'totalPemasukan'));
    }

    public function indexPengeluaran(Request $request)
    {
        $dariTanggal = $request->dari_tanggal;
        $sampaiTanggal = $request->sampai_tanggal;

        $query = Pengeluaran::where('status', 'disetujui');

        if ($dariTanggal && $sampaiTanggal) {
            $query->whereBetween('tanggal_pengeluaran', [$dariTanggal, $sampaiTanggal]);
        }

        $pengeluarans = $query->paginate(10);
        $totalPengeluaran = $query->sum('jumlah_pengeluaran');

        return view('index-pengeluaran', compact('pengeluarans', 'totalPengeluaran'));
    }

    public function detailPengeluaran(string $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('detail-pengeluaran', compact('pengeluaran'));
    }

    public function indexLaporanAkhir(Request $request)
    {
        $dariTanggal = $request->dari_tanggal;
        $sampaiTanggal = $request->sampai_tanggal;

        $query = Pengeluaran::where('status', 'disetujui')
            ->where('laporan_akhir', 'disetujui');

        if ($dariTanggal && $sampaiTanggal) {
            $query->whereBetween('tanggal_pengeluaran', [$dariTanggal, $sampaiTanggal]);
        }

        $pengeluarans = $query->paginate(10);
        $totalPengeluaran = $query->sum('jumlah_pengeluaran');

        return view('index-lap-akhir', compact('pengeluarans', 'totalPengeluaran'));
    }
}
