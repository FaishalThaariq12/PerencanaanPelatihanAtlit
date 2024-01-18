<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vanila Css -->
    <link rel="stylesheet" href="/css/stylee.css">
    <link rel="icon" type="/img/png" href="/img/logoPssi.png">
    <title>Home | Program Pelatihan Atlit</title>
    <!-- AOS css animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')

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

    <!-- Section Hero home page start -->
    <section id="home" class="pt-36  bg-color4">
        <div class="container px-8 lg:px-12">
            <div class="flex flex-wrap">
                <div data-aos="fade-left" data-aos-duration="1500" class="w-full self-end  md:mb-72 lg:w-1/2">
                    <iframe width="660" height="415" src="https://www.youtube.com/embed/yW9azDCsf2I?" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <!-- Div hero banner1 -->
                <div data-aos="fade-right" data-aos-duration="1500" class="w-full self-center px-5 md:mb-72 lg:w-1/2">
                    <h1 class="text-3xl font-bold text-color4 md:text-3xl" style="color: black;">
                        Selamat Datang Di Program Pelatihan Synchronize
                    </h1>
                    <h2 class="font-medium text-color4 text-lg mb-5" style="color: black;"></h2>
                    <p class="font-medium text-color4 mb-10 leading-relaxed" style="color: black;">Program Pelatihan Sepak Bola Kami menawarkan pengaturan program pelatihan untuk meningkatkan kinerja atlet dalam olahraga tertentu. Tujuan utama dari perencanaan ini adalah mencapai hasil yang optimal dalam kompetisi dengan memaksimalkan potensi atlet, mengembangkan keterampilan teknis dan taktis, meningkatkan kebugaran fisik, serta memperkuat aspek mental.
                    </p>
                    <!-- <a href="#" class="text-base font-semibold text-black bg-color5 py-4 px-8 rounded-full 
                hover:shadow-lg hover:bg-white hover:text-black-600 hover:opacity-80 transition duration-300 ease-in-out">
                    Baca Lengkap</a> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Section Hero home page end -->


    <!-- Section Footer  -->
    <footer class="bg-black text-white text-xs sm:text-base text-center pt-4 pb-4 font-mono">
        © Copyright 2024 - <span class="text-yellow-600">Synchronize</span>
    </footer>

    <!-- AOS animation scrool script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = 90;
            let skillBar = document.getElementById('skillBar');
            skillBar.style.transition = 'width 2s ease-in-out';
            skillBar.style.width = nilaiKet + '%';
            skillBar.innerText = nilaiKet + '%';
        });
    </script>
    <script src="/js/script.js"></script>
</body>

</html>