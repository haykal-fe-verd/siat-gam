<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Berita</h4>
            <div class="card-header-action">
                <a href="{{ route('berita.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Berita</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="data-table-laravel">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Thumbnail</th>
                            <th>Aksi</th>
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
                    ajax: "{{ route('berita.index') }}",
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
                            data: 'judul',
                            name: 'judul'
                        },
                        {
                            data: 'isi',
                            name: 'isi'
                        },
                        {
                            data: 'thumbnail',
                            name: 'thumbnail',
                            render: function(data, type, row) {
                                return '<img src="' + data +
                                    '" class="thumbnail-preview img-custom text-center">';
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
                                    '<button type="button" onclick="window.location.href=\'' + row
                                    .edit_url +
                                    '\'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>' +

                                    '<button type="button" onclick="showConfirmation(\'' + row
                                    .delete_url +
                                    '\')" class="btn btn-sm btn-danger delete-button"><i class="fas fa-trash-alt"></i></button>' +

                                    '</div>';
                            }
                        }
                    ]
                });
            });
        </script>
        <script>
            function showConfirmation(deleteUrl) {
                swal({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((willDelete) => {
                    if (willDelete) {
                        deleteData(deleteUrl);
                    }
                });
            }

            function deleteData(deleteUrl) {
                var table = $('#data-table-laravel')
                $.ajax({
                    url: deleteUrl,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.DataTable().ajax.reload();
                        iziToast.success({
                            message: response.message,
                            position: 'topRight'
                        });
                    },
                    error: function(xhr, status, error) {
                        // Proses kesalahan saat penghapusan
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
