<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Laporan Pengaduan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="data-table-laravel">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Likes</th>
                            <th>Foto</th>
                            <th>Pengaduan</th>
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
                $('#data-table-laravel').DataTable({
                    serverSide: true,
                    ajax: "{{ route('pengaduan.keuchik.index') }}",
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
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'no_hp',
                            name: 'no_hp'
                        },
                        {
                            data: 'like_count',
                            name: 'like_count'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data, type, row) {
                                return '<img src="' + data +
                                    '" class="thumbnail-preview img-custom text-center">';
                            }
                        },
                        {
                            data: 'pengaduan',
                            name: 'pengaduan',
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
