@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Taktik')
@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $taktik->title }}</h1>
                <a href="/dashboard/taktiks/" class="btn btn-success"><span data-feather="arrow-left"></span> Back
                    to All Taktik</a>
                <a href="/dashboard/taktiks/{{ $taktik->slug }}/edit" class="btn btn-warning"><span
                        data-feather="edit"></span>Edit</a>
                <form action="/dashboard/taktiks/{{ $taktik->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                            data-feather="x-circle"></span>Delete</button>
                </form>

                <!-- Check if there's a YouTube ID -->
                    <iframe width="660" height="415" src="https://www.youtube.com/embed/{{ $taktik->youtube_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @if ($taktik->image_cover)
                    <div style="max-height: 400px; overflow:hidden">
                        <img src="{{ asset('storage/' . $taktik->image_cover) }}" alt="{{ $taktik->name }}"
                            class="img-fluid mt-3">
                    </div>
                @else
                    <img src="/img/defaultimg.png{{ $taktik->name }}" alt="{{ $taktik->name }}" class="img-fluid mt-3">
                @endif
                <article class="my-3 fs-5"></article> {!! $taktik->deskripsi !!} </article>
            </div>
        </div>
    </div>
@endsection
