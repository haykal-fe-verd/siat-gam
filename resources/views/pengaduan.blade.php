<x-guest-layout>
    <section class="pengaduan" id="pengaduan" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Pengaduan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <!-- nama-->
                                <div class="form-group">
                                    <label for="nama"><span class="text-danger"><sup>*</sup></span>Nama</label>
                                    <input type="text" class="form-control  @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- email -->
                                <div class="form-group mt-3">
                                    <label for="email"><span class="text-danger"><sup>*</sup></span>Email</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- no_hp -->
                                <div class="form-group mt-3">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control  @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- foto -->
                                <div class="form-group mt-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control  @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" value="{{ old('foto') }}">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- alamat -->
                                <div class="form-group mt-3">
                                    <button type="button" id="btnTambahAlamat" class="btn btn-primary">
                                        + Tambah alamat baru
                                    </button>
                                    <input type="hidden" class="form-control @error('alamat') is-invalid @enderror"
                                        id="alamat" name="alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3" id="alamatFields" style="display: none;">
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <div id="map" style="height: 300px;"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <!--pengaduan-->
                                <div class="form-group">
                                    <label><span class="text-danger"><sup>*</sup></span>Pengaduan</label>
                                    <textarea class="form-control @error('pengaduan') is-invalid @enderror" name="pengaduan" id="pengaduan" rows="15">{{ old('pengaduan') }}</textarea>
                                    @error('pengaduan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-kirim">Ajukan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('script')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var btnTambahAlamat = document.getElementById('btnTambahAlamat');
                var alamatFields = document.getElementById('alamatFields');
                var mapContainer = document.getElementById('map');
                var map;

                btnTambahAlamat.addEventListener('click', function() {
                    if ("geolocation" in navigator) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;

                            // Simpan lokasi ke input tersembunyi di dalam form
                            document.getElementById('latitude').value = latitude;
                            document.getElementById('longitude').value = longitude;
                            document.getElementById('alamat').value = latitude + ', ' + longitude;

                            // Tampilkan field alamat
                            alamatFields.style.display = 'block';

                            // Tampilkan peta menggunakan Leaflet
                            map = L.map('map').setView([latitude, longitude], 16);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            // Tambahkan marker pada lokasi saat ini
                            L.marker([latitude, longitude]).addTo(map)
                                .bindPopup('Lokasi Anda').openPopup();

                        });
                    } else {
                        alert("Geolocation tidak tersedia pada perangkat Anda.");
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
