@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Pelatihan')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Pelatihan</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/pelatihans" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label"><b>Nama Pelatihan :</b></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenispel" class="form-label"><b>Jenis Pelatihan :</b></label>
                <input type="text" class="form-control @error('jenispel') is-invalid @enderror" id="jenispel"
                    name="jenispel" required autofocus value="{{ old('jenispel') }}">
                @error('jenispel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rolepemain" class="form-label"><b>Untuk Role Pemain :</b></label>
                <input type="text" class="form-control @error('rolepemain') is-invalid @enderror" id="rolepemain"
                    name="rolepemain" required autofocus value="{{ old('rolepemain') }}">
                @error('rolepemain')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            

            <div class="mb-3">
                <label for="slug" class="form-label"><b>Slug :</b></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug"required value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image_cover" class="form-label"><b>Cover Image Pelatihan :</b></label>
                <img src="" class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('image_cover') is-invalid @enderror" type="file" id="image"
                    name="image_cover" onchange="previewImage()">
                @error('image_cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="youtube_url" class="form-label"><b>Link Youtube Refrensi Pelatihan :</b></label>
                <input type="text" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url"
                    name="youtube_url" required autofocus value="{{ old('youtube_url') }}">
                @error('youtube_url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label"><b>Deskripsi :</b></label>
                @error('deskripsi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                <trix-editor input="deskripsi"></trix-editor>
            </div>




            <button type="submit" class="btn btn-primary">Create Pelatihan</button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/pelatihans/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });


        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
