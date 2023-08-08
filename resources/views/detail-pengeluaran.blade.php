<x-guest-layout>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 entries">
                    <div class="section-title">
                        <h2>Detail Pengeluaran {{ $pengeluaran->nomor_pengeluaran }}</h2>
                    </div>

                    <div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nomor/Kode Pengeluaran</td>
                                    <td>{{ $pengeluaran->nomor_pengeluaran }}</td>
                                </tr>
                                <tr>
                                    <td>Sumber Dana</td>
                                    <td>{{ $pengeluaran->pemasukan->nomor_pemasukan }}
                                        -
                                        {{ $pengeluaran->pemasukan->sumber_pemasukan }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Kegiatan</td>
                                    <td>{{ $pengeluaran->nama_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <td>Lama Kegiatan</td>
                                    <td>{{ $pengeluaran->lama_kegiatan }} Hari</td>
                                </tr>
                                <tr>
                                    <td>Penanggung Jawab</td>
                                    <td>{{ $pengeluaran->penanggung_jawab }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengeluaran</td>
                                    <td>{{ $pengeluaran->tanggal_pengeluaran }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pengeluaran</td>
                                    <td>Rp. {{ number_format($pengeluaran->jumlah_pengeluaran) }} ,-</td>
                                </tr>
                            </tbody>
                        </table>


                        <div class="row">
                            @if ($pengeluaran->gambar_awal)
                                <div class="col-4">
                                    <p>Gambar Awal</p>
                                    <img src="{{ Storage::url($pengeluaran->gambar_awal) }}" alt="Gambar awal"
                                        width="100%" height="400px" style="object-fit: cover">
                                </div>
                            @endif

                            @if ($pengeluaran->gambar_tengah)
                                <div class="col-4">
                                    <p>Gambar Tengah</p>
                                    <img src="{{ Storage::url($pengeluaran->gambar_tengah) }}" alt="Gambar tengah"
                                        width="100%" height="400px" style="object-fit: cover">
                                </div>
                            @endif

                            @if ($pengeluaran->gambar_akhir)
                                <div class="col-4">
                                    <p>Gambar Akhir</p>
                                    <img src="{{ Storage::url($pengeluaran->gambar_akhir) }}" alt="Gambar akhir"
                                        width="100%" height="400px" style="object-fit: cover">
                                </div>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('all.pengeluaran') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
