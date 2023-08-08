<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use DataTables;

class PemasukanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemasukan::query();

            // Filter berdasarkan rentang tanggal
            if ($request->filled('dari_tanggal') && $request->filled('sampai_tanggal')) {
                $dariTanggal = $request->dari_tanggal;
                $sampaiTanggal = $request->sampai_tanggal;

                $data->whereBetween('tanggal_pemasukan', [$dariTanggal, $sampaiTanggal]);
            }

            $data = $data->get();

            $data->transform(function ($item, $key) {
                $item->DT_RowIndex = $key + 1;
                $item->detail_url = route('pemasukan.show', $item->id);
                $item->csrf_token = csrf_token();
                return $item;
            });

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('app.pemasukan.index');
    }


    public function show(string $id)
    {
        $data = Pemasukan::findOrFail($id);

        return view('app.pemasukan.show', compact('data'));
    }
}
