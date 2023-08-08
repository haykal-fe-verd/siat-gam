<x-guest-layout>
    <section id="pengaduan">
        <div class="container">
            <div class="section-title">
                <h2>Laporan Pemasukan</h2>
            </div>
            <form action="{{ route('all.pemasukan') }}" method="GET">
                <div class="row">
                    <div class="col-4">
                        <input id="dari_tanggal" class="form-control" type="date" name="dari_tanggal"
                            value="{{ old('dari_tanggal') }}">
                    </div>
                    <div class="col-4">
                        <input id="sampai_tanggal" class="form-control" type="date" name="sampai_tanggal"
                            value="{{ old('sampai_tanggal') }}">
                    </div>
                    <div class="col-4 d-flex justify-content-start my-auto">
                        <button id="filterBtn" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            <span>Cari</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12 mt-3">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="align-middle">
                                <tr>
                                    <th style="width: 20px; text-align: center">No</th>
                                    <th>Kode Pemasukan</th>
                                    <th>Sumber Pemasukan</th>
                                    <th style="width: 200px; text-align: center">Tanggal</th>
                                    <th style="width: 300px; text-align: center">Jumlah Pemasukan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemasukans as $pemasukan)
                                    <tr>
                                        <td style="width: 20px; text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $pemasukan->nomor_pemasukan }}</td>
                                        <td>{{ $pemasukan->sumber_pemasukan }}</td>
                                        <td style="text-align: center">{{ $pemasukan->tanggal_pemasukan }}</td>
                                        <td style="width: 300px; text-align: right">Rp.
                                            {{ number_format($pemasukan->jumlah_pemasukan) }} ,-</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td style="text-align: right">Rp. {{ number_format($totalPemasukan) }} ,-</td>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $pemasukans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
