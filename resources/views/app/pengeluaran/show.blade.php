<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Detail Pengeluaran</h4>
            <div class="card-header-action">
                <button type="button" class="btn btn-primary" onclick="printData()">
                    <i class="fas fa-print"></i>
                    <span>Print</span>
                </button>
            </div>
        </div>

        <div class="card-body" id="print-section">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2">
                            Detail Pengeluaran {{ $data->nomor_pengeluaran }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nomor/Kode Pengeluaran</td>
                        <td>{{ $data->nomor_pengeluaran }}</td>
                    </tr>
                    <tr>
                        <td>Sumber Dana</td>
                        <td><a href="{{ route('pemasukan.show', $data->id) }}">{{ $data->pemasukan->nomor_pemasukan }} -
                                {{ $data->pemasukan->sumber_pemasukan }}</a></td>
                    </tr>
                    <tr>
                        <td>Nama Kegiatan</td>
                        <td>{{ $data->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>Lama Kegiatan</td>
                        <td>{{ $data->lama_kegiatan }} Hari</td>
                    </tr>
                    <tr>
                        <td>Penanggung Jawab</td>
                        <td>{{ $data->penanggung_jawab }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengeluaran</td>
                        <td>{{ $data->tanggal_pengeluaran }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Pengeluaran</td>
                        <td>Rp. {{ number_format($data->jumlah_pengeluaran) }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            @if ($data->status === 'menunggu')
                                <span class="badge badge-warning">{{ $data->status }}</span>
                            @elseif ($data->status === 'ditolak')
                                <span class="badge badge-danger">{{ $data->status }}</span>
                            @else
                                <span class="badge badge-success">{{ $data->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pesan</td>
                        <td>{{ $data->pesan ? $data->pesan : '-' }}</td>
                    </tr>
                </tbody>
            </table>

            @if ($data->gambar_awal)
                <div class="row">
                    <div class="col-4">
                        <p>Gambar Awal</p>
                        <img src="{{ Storage::url($data->gambar_awal) }}" alt="Gambar awal" width="100%"
                            height="400px" style="object-fit: cover">
                    </div>
                    <div class="col-4">
                        <p>Gambar Tengah</p>
                        <img src="{{ Storage::url($data->gambar_tengah) }}" alt="Gambar tengah" width="100%"
                            height="400px" style="object-fit: cover">
                    </div>
                    <div class="col-4">
                        <p>Gambar Akhir</p>
                        <img src="{{ Storage::url($data->gambar_akhir) }}" alt="Gambar akhir" width="100%"
                            height="400px" style="object-fit: cover">
                    </div>
                </div>
            @endif

        </div>
        <div class="card-footer bg-whitesmoke">
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>

    @push('script')
        <script>
            function printData() {
                var printContents = document.getElementById('print-section').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    @endpush
</x-app-layout>
