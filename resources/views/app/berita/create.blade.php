<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Berita</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" id="judul" value="{{ old('judul') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" name="isi" id="isi">{{ old('isi') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" class="form-control  @error('thumbnail') is-invalid @enderror"
                                    name="thumbnail" id="thumbnail">
                            </div>
                        </div>

                        <!--preview-->
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-7 offset-md-3">
                                <div class="thumbnail-container"></div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a href="{{ route('berita.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <style>
            .thumbnail-preview {
                max-width: 200px;
                margin-top: 10px;
            }
        </style>
    @endpush

    @push('script')
        <script>
            // Fungsi untuk membuat pratinjau thumbnail
            function previewThumbnail(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Buat elemen gambar baru
                        var imagePreview = document.createElement('img');
                        imagePreview.setAttribute('src', e.target.result);
                        imagePreview.setAttribute('class', 'thumbnail-preview');

                        // Hapus pratinjau gambar sebelumnya (jika ada)
                        var existingPreview = document.querySelector('.thumbnail-preview');
                        if (existingPreview) {
                            existingPreview.remove();
                        }

                        // Tambahkan pratinjau gambar ke dalam form
                        var thumbnailContainer = document.querySelector('.thumbnail-container');
                        thumbnailContainer.appendChild(imagePreview);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Event listener saat memilih file thumbnail
            var thumbnailInput = document.getElementById('thumbnail');
            thumbnailInput.addEventListener('change', function() {
                previewThumbnail(this);
            });

            $(document).ready(function() {
                $('.summernote').summernote();
            });
        </script>
    @endpush
</x-app-layout>
