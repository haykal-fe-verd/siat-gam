<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Verifikasi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>No/Kode</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paginator as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->nomor_pemasukan ?? $item->nomor_pengeluaran }}</td>
                                <td>{{ $item->tanggal_pemasukan ?? $item->tanggal_pengeluaran }}</td>
                                <td>Rp. {{ number_format($item->jumlah_pemasukan ?? $item->jumlah_pengeluaran) }}</td>
                                <td>
                                    @if ($item instanceof \App\Models\Pemasukan)
                                        <span class="badge badge-primary">Pemasukan</span>
                                    @elseif ($item instanceof \App\Models\Pengeluaran)
                                        <span class="badge badge-warning">Pengeluaran</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route($item instanceof \App\Models\Pemasukan ? 'keuchik.pemasukan.show' : 'keuchik.pengeluaran.show', $item->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $paginator->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
