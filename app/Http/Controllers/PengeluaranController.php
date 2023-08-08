<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use DataTables;

class PengeluaranController extends Controller
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
                $item->detail_url = route('pengeluaran.show', $item->id);
                $item->edit_url = route('pengeluaran.edit', $item->id);
                $item->lapakhir_url = route('pengeluaran.laporan.akhir.update', $item->id);
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

        return view('app.pengeluaran.index');
    }

    public function show(string $id)
    {
        $data = Pengeluaran::findOrFail($id);

        return view('app.pengeluaran.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Pengeluaran::findOrFail($id);

        return view('app.pengeluaran.edit', compact('data'));
    }

    public function updateGambar(Request $request, string $id)
    {
        $request->validate([
            'gambar_awal' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_tengah' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_akhir' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')->with('success', 'Foto kegiatan berhasil diperbarui.');
    }

    public function laporanAkhir(string $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->laporan_akhir = "disetujui";
        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')->with('success', 'Laporan akhir berhasil diperbarui.');
    }
}
