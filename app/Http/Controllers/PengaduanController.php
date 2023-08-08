<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use DataTables;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'no_hp' => 'nullable',
            'pengaduan' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengaduan = new Pengaduan();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/foto');
            $pengaduan->foto = $fotoPath;
        }

        $pengaduan->nama = $request->input('nama');
        $pengaduan->alamat = $request->input('alamat');
        $pengaduan->email = $request->input('email');
        $pengaduan->no_hp = $request->input('no_hp');
        $pengaduan->pengaduan = $request->input('pengaduan');
        $pengaduan->latitude = $request->input('latitude');
        $pengaduan->longitude = $request->input('longitude');
        $pengaduan->save();

        Session::put('last_pengaduan_id', $pengaduan->id);

        return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function indexKeuchik(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengaduan::latest()->get();

            $data->transform(function ($item, $key) {
                $item->DT_RowIndex = $key + 1;
                $item->detail_url = route('pengaduan.keuchik.show', $item->id);
                $item->csrf_token = csrf_token();
                return $item;
            });

            return DataTables::of($data)
                ->editColumn('foto', function ($row) {
                    return Storage::url($row->foto);
                })
                ->rawColumns(['foto'])
                ->make(true);
        }

        return view('app.keuchik.pengaduan.index');
    }


    public function like($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $userIp = request()->ip();

        $existingLike = Like::where('pengaduan_id', $pengaduan->id)
            ->where('ip_address', $userIp)
            ->first();

        if (!$existingLike) {
            $like = new Like();
            $like->pengaduan_id = $pengaduan->id;
            $like->ip_address = $userIp;
            $like->save();
            $pengaduan->increment('like_count');

            return redirect()->back()->with('success', 'Pengaduan berhasil dilike.');
        } else {
            $existingLike->delete();
            $pengaduan->decrement('like_count');

            return redirect()->back()->with('success', 'Pengaduan berhasil disliked.');
        }
    }
}
