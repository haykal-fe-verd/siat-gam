<x-app-layout>
    <div class="card">
        <form action="{{ route('pengeluaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <div class="image-preview mb-2">
                                <img id="preview_awal_id" style="max-width: 100%;"
                                    src="{{ Storage::url($data->gambar_awal) }}" alt="Preview Gambar">
                            </div>
                            <label for="gambar_awal">Gambar Awal</label>
                            <input type="file" class="form-control @error('gambar_awal') is-invalid @enderror"
                                name="gambar_awal" id="gambar_awal" onchange="previewImage(this, 'preview_awal_id')">
                            @error('gambar_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <div class="image-preview mb-2">
                                <img id="preview_tengah_id" style="max-width: 100%;"
                                    src="{{ Storage::url($data->gambar_tengah) }}" alt="Preview Gambar">
                            </div>
                            <label for="gambar_tengah">Gambar Tengah</label>
                            <input type="file" class="form-control @error('gambar_tengah') is-invalid @enderror"
                                name="gambar_tengah" id="gambar_tengah"
                                onchange="previewImage(this, 'preview_tengah_id')">
                            @error('gambar_tengah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <div class="image-preview mb-2">
                                <img id="preview_akhir_id" style="max-width: 100%;"
                                    src="{{ Storage::url($data->gambar_akhir) }}" alt="Preview Gambar">
                            </div>
                            <label for="gambar_akhir">Gambar Akhir</label>
                            <input type="file" class="form-control @error('gambar_akhir') is-invalid @enderror"
                                name="gambar_akhir" id="gambar_akhir" onchange="previewImage(this, 'preview_akhir_id')">
                            @error('gambar_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-whitesmoke">
                <x-button-primary>
                    Edit
                </x-button-primary>
                <a href="{{ route('pengeluaran.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>

    @push('script')
        <script>
            function previewImage(input, previewId) {
                var previewElement = document.getElementById(previewId);
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                };

                if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
</x-app-layout>
