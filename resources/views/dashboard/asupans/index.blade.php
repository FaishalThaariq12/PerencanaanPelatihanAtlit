@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Asupan')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Postingan Untuk Halaman Rekomendasi Asupan Gizi</h1>
    </div>


    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="my-3 col-12 col-sm-8 col-md5">
        <form action="/dashboard/asupans" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="cari sesuatu.." name="keyword">
                <button class="btn btn-primary border-primary " type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="table-responsive col-lg-10">
        <a href="/dashboard/asupans/create" class="btn btn-primary mb-3">Create New Asupan Gizi</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No Id</th>
                    <th scope="col">Nama Rekomendasi asupan</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asupans as $asupan)
                    <tr>
                        <td>{{ $asupan->iteration }}</td>
                        <td>{{ $asupan->title }}</td>
                        <td>{{ $asupan->created_at }}</td>
                        <td>{{ $asupan->updated_at }}</td>
                        <td>
                            <a href="/dashboard/asupans/{{ $asupan->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/asupans/{{ $asupan->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/asupans/{{ $asupan->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                        data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $asupans->links() }}
        </table>
    </div>
@endsection
