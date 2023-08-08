<x-guest-layout>
    <section id="pengaduan">
        <div class="container">
            <div class="section-title">
                <h2>Laporan Akhir</h2>
            </div>
            <form action="{{ route('all.lap.akhir') }}" method="GET">
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
                            <thead class="align-middle text-center">
                                <tr>
                                    <th style="width: 20px; text-align: center">No</th>
                                    <th>Sumber Pengeluaran</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Tanggal</th>
                                    <th>Lama Kegiatan</th>
                                    <th>Jumlah Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluarans as $pengeluaran)
                                    <tr>
                                        <td style="width: 20px; text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengeluaran->pemasukan->nomor_pemasukan }}</td>
                                        <td>
                                            <a href="{{ route('detail.pengeluaran', $pengeluaran->id) }}">
                                                {{ $pengeluaran->nama_kegiatan }}
                                            </a>
                                        </td>
                                        <td>{{ $pengeluaran->penanggung_jawab }}</td>
                                        <td style="text-align: center">{{ $pengeluaran->tanggal_pengeluaran }}</td>
                                        <td style="text-align: right">{{ $pengeluaran->lama_kegiatan }} Hari </td>

                                        <td style="width: 300px; text-align: right">Rp.
                                            {{ number_format($pengeluaran->jumlah_pengeluaran) }} ,-</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">Total</td>
                                    <td style="text-align: right">Rp. {{ number_format($totalPengeluaran) }} ,-</td>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $pengeluarans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
