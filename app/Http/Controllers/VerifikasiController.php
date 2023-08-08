<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class VerifikasiController extends Controller
{
    public function index()
    {
        $dataPemasukan = Pemasukan::where('status', 'disetujui')->latest()->get();
        return view('app.verifikasi.index', compact('dataPemasukan'));
    }

    public function pemasukanStore(Request $request)
    {
        $request->validate([
            'nomor_pemasukan' => 'required|unique:tb_pemasukan,nomor_pemasukan',
            'sumber_pemasukan' => 'required',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_pemasukan' => 'required',
        ]);

        $pemasukan = new Pemasukan();
        $pemasukan->nomor_pemasukan = $request->input('nomor_pemasukan');
        $pemasukan->sumber_pemasukan = $request->input('sumber_pemasukan');
        $pemasukan->tanggal_pemasukan = $request->input('tanggal_pemasukan');
        $pemasukan->jumlah_pemasukan = $request->input('jumlah_pemasukan');
        $pemasukan->save();

        return redirect()->route('verifikasi.index')->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    public function pengeluaranStore(Request $request)
    {
        $request->validate([
            'nomor_pengeluaran' => 'required|unique:tb_pengeluaran,nomor_pengeluaran',
            'sumber_dana' => 'required',
            'nama_kegiatan' => 'required',
            'lama_kegiatan' => 'required',
            'penanggung_jawab' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->nomor_pengeluaran = $request->input('nomor_pengeluaran');
        $pengeluaran->sumber_dana = $request->input('sumber_dana');
        $pengeluaran->nama_kegiatan = $request->input('nama_kegiatan');
        $pengeluaran->lama_kegiatan = $request->input('lama_kegiatan');
        $pengeluaran->penanggung_jawab = $request->input('penanggung_jawab');
        $pengeluaran->tanggal_pengeluaran = $request->input('tanggal_pengeluaran');
        $pengeluaran->jumlah_pengeluaran = $request->input('jumlah_pengeluaran');
        $pengeluaran->save();

        return redirect()->route('verifikasi.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function indexKeuchik()
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $dataPemasukan = Pemasukan::where('status', 'menunggu')
            ->orderBy('tanggal_pemasukan', 'desc')
            ->offset(($currentPage - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $dataPengeluaran = Pengeluaran::where('status', 'menunggu')
            ->orderBy('tanggal_pengeluaran', 'desc')
            ->offset(($currentPage - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $data = $dataPemasukan->concat($dataPengeluaran);
        $totalCount = count($data);

        $paginator = new LengthAwarePaginator($data, $totalCount, $perPage, $currentPage);
        $paginator->withPath('');

        return view('app.keuchik.verifikasi.index', compact('paginator'));
    }

    public function showPemasukan(string $id)
    {
        $data = Pemasukan::findOrFail($id);

        return view('app.keuchik.verifikasi.show-pemasukan', compact('data'));
    }
    public function showPengeluaran(string $id)
    {
        $data = Pengeluaran::findOrFail($id);

        return view('app.keuchik.verifikasi.show-pengeluaran', compact('data'));
    }

    public function updatePemasukan(Request $request, string $id)
    {
        $request->validate([
            'pesan' => 'required',
        ]);

        $data = Pemasukan::findOrFail($id);

        if ($request->has('setujui')) {
            $data->status = 'disetujui';
            $data->pesan = $request->input('pesan');
            $data->save();

            return redirect()->route('verifikasi.keuchik.index')->with('success', 'Pemasukan berhasil disetujui.');
        }

        if ($request->has('tolak')) {
            $data->status = 'ditolak';
            $data->pesan = $request->input('pesan');
            $data->save();

            return redirect()->route('verifikasi.keuchik.index')->with('success', 'Pemasukan berhasil ditolak.');
        }
        return back();
    }

    public function updatePengeluaran(Request $request, string $id)
    {
        $request->validate([
            'pesan' => 'required',
        ]);

        $data = Pengeluaran::findOrFail($id);

        if ($request->has('setujui')) {
            $data->status = 'disetujui';
            $data->pesan = $request->input('pesan');
            $data->save();

            return redirect()->route('verifikasi.keuchik.index')->with('success', 'Pengeluaran berhasil disetujui.');
        }

        if ($request->has('tolak')) {
            $data->status = 'ditolak';
            $data->pesan = $request->input('pesan');
            $data->save();

            return redirect()->route('verifikasi.keuchik.index')->with('success', 'Pengeluaran berhasil ditolak.');
        }
        return back();
    }
}
