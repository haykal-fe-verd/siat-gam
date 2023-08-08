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
        <form action="{{ route('keuchik.pemasukan.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                            <td colspan="2">
                                <div class="form-group mt-3">
                                    <label>Pesan</label>
                                    <textarea name="pesan" id="pesan" class="form-control  @error('pesan') is-invalid @enderror">{{ old('pesan', $data->pesan) }}</textarea>
                                    @error('pesan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-whitesmoke">
                <button type="submit" name="setujui" class="btn btn-primary">
                    <i class="fas fa-check"></i>
                    <span>Setujui</span>
                </button>
                <button type="submit" name="tolak" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                    <span>Tolak</span>
                </button>
                <a href="{{ route('pemasukan.index') }}" class="btn btn-warning">Kembali</a>
            </div>
        </form>
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
