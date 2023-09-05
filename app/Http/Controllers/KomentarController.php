<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'komentar' => 'required',
        ]);

        $komentar = new Komentar();
        $komentar->pengaduan_id = $id;
        $komentar->nama = $request->nama;
        $komentar->komentar = $request->komentar;
        $komentar->save();

        return redirect()->route('home')->with('success', 'Komentar berhasil ditambahkan');
    }
}
