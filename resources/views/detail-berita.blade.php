<x-guest-layout>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 entries">
                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            {{ $berita->judul }}
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-clock"></i>
                                    <a href="#">
                                        <time>{{ $berita->created_at->diffForHumans() }}</time>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            {!! $berita->isi !!}
                        </div>

                        <div class="entry-footer">
                        </div>

                    </article>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
