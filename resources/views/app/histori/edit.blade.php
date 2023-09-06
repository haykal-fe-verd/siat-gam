<x-app-layout>
    <div class="card">
        <form action="{{ route('histori.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" class="form-control @error('gambar_awal') is-invalid @enderror"
                                name="gambar_awal" id="gambar_awal" onchange="previewImage(this, 'preview_awal_id')">
                            @error('gambar_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="proses1"><span class="text-danger"><sup>*</sup></span>Proses</label>
                            <input type="text" class="form-control  @error('proses1') is-invalid @enderror"
                                id="proses1" name="proses1" value="{{ old('proses1', $data->proses1) }}">
                            @error('proses1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan1"><span class="text-danger"><sup>*</sup></span>Keterangan</label>
                            <textarea class="summernote-simple" name="keterangan1" id="keterangan1">{{ old('keterangan1', $data->keterangan1) }}</textarea>
                            @error('keterangan1')
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
                            <input type="file" class="form-control @error('gambar_tengah') is-invalid @enderror"
                                name="gambar_tengah" id="gambar_tengah"
                                onchange="previewImage(this, 'preview_tengah_id')">
                            @error('gambar_tengah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="proses2"><span class="text-danger"><sup>*</sup></span>Proses</label>
                            <input type="text" class="form-control  @error('proses2') is-invalid @enderror"
                                id="proses2" name="proses2" value="{{ old('proses2', $data->proses2) }}">
                            @error('proses2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan2"><span class="text-danger"><sup>*</sup></span>Keterangan</label>
                            <textarea class="summernote-simple" name="keterangan2" id="keterangan2">{{ old('keterangan2', $data->keterangan2) }}</textarea>
                            @error('keterangan2')
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
                            <input type="file" class="form-control @error('gambar_akhir') is-invalid @enderror"
                                name="gambar_akhir" id="gambar_akhir" onchange="previewImage(this, 'preview_akhir_id')">
                            @error('gambar_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="proses3"><span class="text-danger"><sup>*</sup></span>Proses</label>
                            <input type="text" class="form-control  @error('proses3') is-invalid @enderror"
                                id="proses3" name="proses3" value="{{ old('proses3', $data->proses3) }}">
                            @error('proses3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan3"><span class="text-danger"><sup>*</sup></span>Keterangan</label>
                            <textarea class="summernote-simple" name="keterangan3" id="keterangan3">{{ old('keterangan3', $data->keterangan3) }}</textarea>
                            @error('keterangan3')
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
            $(document).ready(function() {
                $('.summernote').summernote();
            });

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
