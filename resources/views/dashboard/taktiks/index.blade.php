@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Taktik')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Postingan Untuk Halaman Taktik</h1>
    </div>


    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="my-3 col-12 col-sm-8 col-md5">
        <form action="/dashboard/taktiks" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="cari sesuatu.." name="keyword">
                <button class="btn btn-primary border-primary " type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="table-responsive col-lg-10">
        <a href="/dashboard/taktiks/create" class="btn btn-primary mb-3">Create New Taktik</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No Id</th>
                    <th scope="col">Nama Taktik</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taktiks as $taktik)
                    <tr>
                        <td>{{ $taktik->iteration }}</td>
                        <td>{{ $taktik->title }}</td>
                        <td>{{ $taktik->created_at }}</td>
                        <td>{{ $taktik->updated_at }}</td>
                        <td>
                            <a href="/dashboard/taktiks/{{ $taktik->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/taktiks/{{ $taktik->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/taktiks/{{ $taktik->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                        data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $taktiks->links() }}
        </table>
    </div>
@endsection
