@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Statistik')
@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $statistik->title }}</h1>
                <a href="/dashboard/statistiks/" class="btn btn-success"><span data-feather="arrow-left"></span> Back
                    to All statistik</a>
                <a href="/dashboard/statistiks/{{ $statistik->slug }}/edit" class="btn btn-warning"><span
                        data-feather="edit"></span>Edit</a>
                <form action="/dashboard/statistiks/{{ $statistik->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                            data-feather="x-circle"></span>Delete</button>
                </form>
                @if ($statistik->image_pemain)
                    <div style="max-height: 400px; overflow:hidden">
                        <img src="{{ asset('storage/' . $statistik->image_pemain) }}" alt="{{ $statistik->name }}"
                            class="img-fluid mt-3">
                    </div>
                @else
                    <img src="/img/defaultimg.png{{ $statistik->name }}" alt="{{ $statistik->name }}" class="img-fluid mt-3">
                @endif
                <article class="my-3 fs-5"></article> {!! $statistik->deskripsi !!} </article>
            </div>
        </div>
    </div>
@endsection
