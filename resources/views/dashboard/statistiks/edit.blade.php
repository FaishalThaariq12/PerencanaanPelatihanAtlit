@extends('dashboard.layouts.main')
@section('title', 'Dashboard-Statistik')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Statistik</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/statistiks/{{ $statistik->slug }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label"><b>Nama Pemain :</b></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" required autofocus value="{{ old('title', $statistik->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label for="rolepemain" class="form-label"><b>Role Pemain :</b></label>
                <input type="text" class="form-control @error('rolepemain') is-invalid @enderror" id="rolepemain"
                    name="rolepemain" required autofocus value="{{ old('rolepemain', $statistik->rolepemain) }}">
                @error('rolepemain')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label type="slug" class="form-label"><b>Slug :</b></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" required value="{{ old('slug', $statistik->slug) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image_pemain" class="form-label"><b>Cover Image Pemain :</b></label>
                    <input type="hidden" name="oldImage" value="{{ $statistik->image_pemain }}">
                    @if ($statistik->image_pemain)
                        <img src="{{ asset('storage/' . $statistik->image_pemain) }}"
                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control @error('image_pemain') is-invalid @enderror" type="file" id="image"
                        name="image_pemain" onchange="previewImage()">
                    @error('image_pemain')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <label for="speed" class="form-label"><b>Speed Pemain :</b></label>
                <input type="number" class="form-control @error('speed') is-invalid @enderror" id="speed"
                    name="speed" required min="1" max="100" autofocus value="{{ old('speed', $statistik->speed) }}">
                @error('speed')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label for="dribble" class="form-label"><b>Dribble Pemain :</b></label>
                <input type="number" class="form-control @error('dribble') is-invalid @enderror" id="dribble"
                    name="dribble" required min="1" max="100" autofocus value="{{ old('dribble', $statistik->dribble) }}">
                @error('dribble')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label for="passing" class="form-label"><b>Passing Pemain :</b></label>
                <input type="number" class="form-control @error('passing') is-invalid @enderror" id="passing"
                    name="passing" required min="1" max="100" autofocus value="{{ old('passing', $statistik->passing) }}">
                @error('passing')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                
                <label for="tackles" class="form-label"><b>Tackles Pemain :</b></label>
                <input type="number" class="form-control @error('tackles') is-invalid @enderror" id="tackles"
                    name="tackles" required min="1" max="100" autofocus value="{{ old('tackles', $statistik->tackles) }}">
                @error('tackles')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label for="durability" class="form-label"><b>Durability Pemain :</b></label>
                <input type="number" class="form-control @error('durability') is-invalid @enderror" id="durability"
                    name="durability" required min="1" max="100" autofocus value="{{ old('durability', $statistik->durability) }}">
                @error('durability')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                

                <button type="submit" class="btn btn-primary">Update Stat Pemain</button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('change', function() {
            fetch('/dashboard/statistiks/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

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
