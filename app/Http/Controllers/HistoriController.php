<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use DataTables;


class HistoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengeluaran::query()->with('pemasukan');

            // Filter berdasarkan rentang tanggal
            if ($request->filled('dari_tanggal') && $request->filled('sampai_tanggal')) {
                $dariTanggal = $request->dari_tanggal;
                $sampaiTanggal = $request->sampai_tanggal;

                $data->whereBetween('tanggal_pengeluaran', [$dariTanggal, $sampaiTanggal]);
            }

            $data = $data->get();

            if ($data->isEmpty()) {
                return response()->json(['message' => 'Tidak ada data untuk ditampilkan.']);
            }

            $data->transform(function ($item, $key) {
                $item->DT_RowIndex = $key + 1;
                $item->detail_url = route('histori.show', $item->id);
                $item->edit_url = route('histori.edit', $item->id);
                $item->lapakhir_url = route('histori.laporan.akhir.update', $item->id);
                $item->csrf_token = csrf_token();
                return $item;
            });

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->addColumn('sumber_dana', function ($row) {
                    return $row->pemasukan->nomor_pemasukan . ' - ' . $row->pemasukan->sumber_pemasukan;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('app.histori.index');
    }

    public function show(string $id)
    {
        $data = Pengeluaran::findOrFail($id);

        return view('app.histori.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Pengeluaran::findOrFail($id);

        return view('app.histori.edit', compact('data'));
    }

    public function updateGambar(Request $request, string $id)
    {
        $request->validate([
            'gambar_awal' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_tengah' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_akhir' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'proses1' => 'nullable',
            'proses2' => 'nullable',
            'proses3' => 'nullable',
            'keterangan1' => 'nullable',
            'keterangan2' => 'nullable',
            'keterangan3' => 'nullable',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        if ($request->gambar_awal) {
            $gambarAwalPath = $request->file('gambar_awal')->store('public/gambar_awal');
            $pengeluaran->gambar_awal = $gambarAwalPath;
        }
        if ($request->gambar_tengah) {
            $gambarTengahPath = $request->file('gambar_tengah')->store('public/gambar_tengah');
            $pengeluaran->gambar_tengah = $gambarTengahPath;
        }
        if ($request->gambar_akhir) {
            $gambarAkhirPath = $request->file('gambar_akhir')->store('public/gambar_akhir');
            $pengeluaran->gambar_akhir = $gambarAkhirPath;
        }
        $pengeluaran->proses1 = $request->input('proses1');
        $pengeluaran->proses2 = $request->input('proses2');
        $pengeluaran->proses3 = $request->input('proses3');
        $pengeluaran->keterangan1 = $request->input('keterangan1');
        $pengeluaran->keterangan2 = $request->input('keterangan2');
        $pengeluaran->keterangan3 = $request->input('keterangan3');
        $pengeluaran->save();

        return redirect()->route('histori.index')->with('success', 'Foto kegiatan berhasil diperbarui.');
    }

    public function laporanAkhir(string $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->laporan_akhir = "disetujui";
        $pengeluaran->save();

        return redirect()->route('histori.index')->with('success', 'Laporan akhir berhasil diperbarui.');
    }
}
