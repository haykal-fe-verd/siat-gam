<x-guest-layout>
    <x-slot name="hero">
        @include('partials.guest-hero')
    </x-slot>

    <section id="pengaduan">
        <div class="container">
            <div class="section-title">
                <h2>Pengaduan</h2>
            </div>
            <div class="row">
                <!--pengaduan-->
                @foreach ($pengaduans as $pengaduan)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3>{{ $pengaduan->nama }}</h3>
                                <a href="{{ route('show.map', ['latitude' => $pengaduan->latitude, 'longitude' => $pengaduan->longitude]) }}"
                                    class="" target="_blank">
                                    lihat alamat
                                </a>
                                <p>{{ $pengaduan->pengaduan }}</p>
                                @if ($pengaduan->foto)
                                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto" class="my-2"
                                        style="height: 150px;width: 100%; object-fit: cover">
                                @endif

                                <form action="{{ route('pengaduan.like', $pengaduan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent">
                                        <i class="fas fa-heart"
                                            style="color: {{ $pengaduan->likes->contains('ip_address', request()->ip()) ? 'red' : 'black' }}"></i>
                                        {{ $pengaduan->like_count }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $pengaduans->links() }}
        </div>

    </section>

    <section id="berita">
        <div class="container">
            <div class="section-title">
                <h2>Berita Terbaru</h2>
            </div>
            <div class="row">
                <!--berita-->
                @foreach ($beritas as $berita)
                    <div class="col-12">
                        <a href="{{ route('detail.berita', $berita->id) }}">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex flex-col">
                                        <div class="me-3">
                                            <img src="{{ Storage::url($berita->thumbnail) }}" class=""
                                                style="width: 150px; height: 150px;" alt="Thumbnail">
                                        </div>
                                        <div class="">
                                            <h2>{{ $berita->judul }}</h2>
                                            <p>{{ $berita->created_at->diffForHumans() }}</p>
                                            <p style="text-align: justify">
                                                {!! strip_tags(Str::limit($berita->isi, 400, '...')) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <a href="" class="btn btn-block btn-primary">Selengkapnya</a>
        </div>
    </section>

    @push('script')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    @endpush
</x-guest-layout>
