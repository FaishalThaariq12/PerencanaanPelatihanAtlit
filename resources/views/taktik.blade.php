<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vanila Css -->
    <link rel="stylesheet" href="/css/stylee.css">
    <link rel="icon" type="/img/png" href="/img/logoPssi.png">
    <title>Pelatihan Atlit | Program Pelatihan Atlit</title>
    <!-- AOS css animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
    <!-- ... Bagian CSS dan lainnya ... -->
    <style>
        /* Menambahkan warna pada tab aktif */
        .active-tab {
            background-color: #E7B10A;
            color: #EEF0E5;
            /* Ganti dengan warna yang Anda inginkan */
        }

        .active-tab:hover {
            background-color: #E7B10A;
            /* Ganti dengan warna yang Anda inginkan */
        }

        /* Menambahkan indikator pada tab aktif */
        .indicator {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #E7B10A;
            /* Warna yang sama dengan background tab */
            transition: bottom 0.3s ease-in-out;
        }

        /* Indikator berpindah saat tab aktif */
        .active-tab .indicator {
            bottom: -8px;
            /* Sesuaikan dengan tinggi indikator */
            border-bottom: 8px solid #EEF0E5;
        }
    </style>

</head>

<body class="overflow-x-hidden max-w-full">

    {{-- Bagian Navbar start --}}
    <header class="fixed top-0 left-0 z-10 flex w-full items-center bg-amber-300">
        <div class="w-full bg-white h-[96px] drop-shadow-lg flex flex-row items-center">
            <div class="w-1/3 pl-5">
                <a href="/" class="text-base mx-5 text-black hover:text-yellow-500 duration-200 font-inter{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <span class="indicator"></span>
                <a href="/datapemain" class="text-base mx-5 text-black hover:text-yellow-500 duration-200 font-inter{{ request()->is('datapemain') ? 'active' : '' }}">Data Atlit</a>
                <span class="indicator"></span>
                <a href="/pelatihan" class="text-base mx-5 text-black hover:text-yellow-500 duration-200 font-inter{{ request()->is('pelatihan') ? 'active' : '' }}">Pelatihan Atlit</a>
                <span class="indicator"></span>
            </div>
            <div class="w-1/3 flex items-center justify-center">
                <a href="/" class="font-bold text-5xl font-quicksand text-balck hover:text-sync-500 duration-200">SYNCHRONIZE</a>
            </div>
            <div class="w-1/3 flex flex-row justify-end pr-10">
                @auth
                <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-100 hover:bg-amber-600 hover:text-white text-sm text-gray-900 font-bold  rounded-xl transition duration-200" href="/dashboard">Dashboard</a>
                <a class="hidden lg:inline-block py-2 px-6 bg-gray-100 hover:bg-amber-600 hover:text-white text-sm text-gray-900 font-bold  rounded-xl transition duration-200">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </a>
                @else
                <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-100 hover:bg-amber-600 hover:text-white text-sm text-gray-900 font-bold  rounded-xl transition duration-200 " href="/login">Sign In</a>
                @endauth
            </div>
        </div>
        </div>
    </header>
    {{-- Bagian Navbar End --}}

    <!-- Section Hero Navigasi page start -->
    <section id="Pelatihan" class=" pt-16 pb-8 bg-color1">
    </section>

    <!-- Section Taktik Kami start -->
    <section id=" Layanan Kami" class="pt-20 pb-32">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="container mx-auto px-8 sm:flex sm:flex-wrap sm:gap-5 sm:justify-evenly">
                    <div class="flex flex-wrap">
                        @if ($taktik->image_cover)
                        <div class="relative mb-10 w-2/5">
                            <img src="{{ asset('storage/' . $taktik->image_cover) }}" alt="{{ $taktik->name }}" class="mb-4">
                        </div>
                        @else
                        <div class="relative mb-10">
                            <p>no Image</p>
                        </div>
                        @endif
                        <div class="relative">
                            <iframe class="mt-4" width="580" height="430" src="https://www.youtube.com/embed/{{ $taktik->youtube_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-lg px-8 py-8 relative mb-10 sm:w-1/2">
                        <h2><b>Nama Taktik :</b> {{ $taktik->title }}</h2>
                        <h3><b>Deskripsi :</b></h3>
                        <p class="text-left lg:text-sm">{!! $taktik->deskripsi !!}</p>
                    </div>
                </div>
            </div>
            <div class=" mx-auto items-center text-center">
                <a href="/pelatihan" class="text-base font-semibold text-white bg-color5 py-2 px-4 rounded-lg 
                hover:shadow-lg hover:bg-white hover:text-color5 hover:opacity-80 transition duration-300 ease-in-out">
                    Kembali</a>
            </div>
        </div>
    </section>
    <!-- Section Taktik Kami Home page end -->

    <!-- Section Footer  -->
    <footer class="bg-black text-white text-xs sm:text-base text-center pt-4 pb-4 font-mono fixed bottom-0 w-full">
        © Copyright 2024 - <span class="text-yellow-600">Synchronize</span>
    </footer>

    <!-- AOS animation scrool script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/script.js"></script>
    <script>
        function openTab(evt, tabName) {
            let tabcontent = document.querySelectorAll('.tabcontent');
            tabcontent.forEach(tab => tab.style.display = 'none');

            let tablinks = document.querySelectorAll('.tablinks');
            tablinks.forEach(tab => tab.classList.remove('active-tab')); // Ubah class yang dihapus menjadi 'active-tab'

            let content = document.getElementById(tabName);
            content.style.display = 'block';
            evt.currentTarget.classList.add('active-tab');

            // Menyembunyikan konten yang tidak aktif
            for (let i = 1; i <= 3; i++) {
                if (`content-${i}` !== tabName) {
                    document.getElementById(`content-${i}`).style.display = 'none';
                }
            }
        }
    </script>

</body>

</html>