<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Berita::latest()->get();

            $data->transform(function ($item, $key) {
                $item->DT_RowIndex = $key + 1;
                $item->detail_url = route('berita.show', $item->id);
                $item->edit_url = route('berita.edit', $item->id);
                $item->delete_url = route('berita.destroy', $item->id);
                $item->csrf_token = csrf_token();
                return $item;
            });

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->editColumn('isi', function ($row) {
                    $content = strip_tags($row->isi);
                    $content = preg_replace('/\s+/', ' ', $content);
                    $content = str_word_count($content, 1);
                    $content = implode(' ', array_slice($content, 0, 50));

                    return $content . '...';
                })
                ->editColumn('thumbnail', function ($row) {
                    return Storage::url($row->thumbnail);
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make(true);
        }

        return view('app.berita.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');

        $berita = new Berita();
        $berita->judul = $request->input('judul');
        $berita->isi = $request->input('isi');
        $berita->thumbnail = $thumbnailPath;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Berita::findOrFail($id);

        return view('app.berita.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Berita::findOrFail($id);

        return view('app.berita.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->input('judul');
        $berita->isi = $request->input('isi');

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && file_exists(storage_path('app/public/' . $berita->thumbnail))) {
                unlink(storage_path('app/public/' . $berita->thumbnail));
            }

            $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');
            $berita->thumbnail = $thumbnailPath;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->thumbnail && Storage::exists($berita->thumbnail)) {
            Storage::delete($berita->thumbnail);
        }

        $berita->delete();
        return response()->json(['message' => 'Berita berhasil dihapus.']);
    }
}
