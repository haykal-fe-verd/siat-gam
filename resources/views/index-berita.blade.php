<x-guest-layout>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 entries">
                    @foreach ($beritas as $berita)
                        <article class="entry">
                            <div class="entry-img">
                                <img src="{{ Storage::url($berita->thumbnail) }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="{{ route('detail.berita', $berita->id) }}">{{ $berita->judul }}</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i> <a href="{{ route('detail.berita', $berita->id) }}">
                                            <time
                                                datetime="2020-01-01">{{ $berita->created_at->diffForHumans() }}</time></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {!! strip_tags(Str::limit($berita->isi, 400, '...')) !!}
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('detail.berita', $berita->id) }}">Read More</a>
                                </div>
                            </div>

                        </article>
                    @endforeach

                    <div class="blog-pagination">
                        {{ $beritas->links() }}
                    </div>

                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
