<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Pemasukan</h4>
        </div>
        <div class="card-body">
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
                        <span>Filter</span>
                    </button>
                    <a href="{{ route('verifikasi.index') }}" class="ml-3 btn btn-primary">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Pemasukan</span>
                    </a>
                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-striped w-100" id="data-table-laravel">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>
                                #
                            </th>
                            <th>No/Kode</th>
                            <th>Sumber</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {

                $('#filterBtn').click(function() {
                    // Mendapatkan nilai dari input tanggal
                    var dariTanggal = $('#dari_tanggal').val();
                    var sampaiTanggal = $('#sampai_tanggal').val();

                    // Membuat URL filter dengan parameter tanggal
                    var filterUrl = "{{ route('pemasukan.index') }}?dari_tanggal=" + dariTanggal +
                        "&sampai_tanggal=" + sampaiTanggal;

                    // Mengupdate URL ajax DataTables dengan URL filter
                    var table = $('#data-table-laravel').DataTable();
                    table.ajax.url(filterUrl).load();
                });

                $('#data-table-laravel').dataTable({
                    serverSide: true,
                    ajax: "{{ route('pemasukan.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return data;
                            }
                        },
                        {
                            data: 'nomor_pemasukan',
                            name: 'nomor_pemasukan'
                        },
                        {
                            data: 'sumber_pemasukan',
                            name: 'sumber_pemasukan'
                        },
                        {
                            data: 'tanggal_pemasukan',
                            name: 'tanggal_pemasukan'
                        },
                        {
                            data: 'jumlah_pemasukan',
                            name: 'jumlah_pemasukan',
                            render: function(data, type, row) {
                                return 'Rp. ' + data.toLocaleString('en');
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                let badgeClass = "";
                                if (data === "menunggu") {
                                    badgeClass = "badge-warning"
                                } else if (data === "ditolak") {
                                    badgeClass = "badge-danger"
                                } else if (data === "disetujui") {
                                    badgeClass = "badge-success"
                                }
                                return '<span class="badge ' +
                                    badgeClass + '">' + data + '</span>';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<div class="btn-group" role="group">' +
                                    '<button type="button" onclick="window.location.href=\'' + row
                                    .detail_url +
                                    '\'" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></button>' +
                                    '</div>';
                            }
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ],
                });
            });
        </script>
    @endpush
</x-app-layout>
