<x-app-layout>
    <div class="card">
        <div class="card-body">
            <img src="{{ Storage::url($data->thumbnail) }}" class="img-thumbnail mx-auto d-block" alt="Thumbnail"
                style="width: 100%; height: 500px; object-fit: cover">
            <h4 class="mt-3">{{ $data->judul }}</h4>
            <p>{{ $data->created_at->diffForHumans() }}</p>
            <div class="">
                {!! $data->isi !!}
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <a href="{{ route('berita.index') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</x-app-layout>
