<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Detail Pemasukan</h4>
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
                            Detail Pemasukan {{ $data->nomor_pemasukan }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nomor/Kode Pemasukan</td>
                        <td>{{ $data->nomor_pemasukan }}</td>
                    </tr>
                    <tr>
                        <td>Sumber Pemasukan</td>
                        <td>{{ $data->sumber_pemasukan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pemasukan</td>
                        <td>{{ $data->tanggal_pemasukan }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Pemasukan</td>
                        <td>Rp. {{ number_format($data->jumlah_pemasukan) }}</td>
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
        </div>
        <div class="card-footer bg-whitesmoke">
            <a href="{{ route('pemasukan.index') }}" class="btn btn-danger">Kembali</a>
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
