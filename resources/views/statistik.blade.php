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
    <header class="absolute top-0 left-0 z-10 flex w-full items-center bg-transparent">
        <div class="container">
            <div class="relative flex items-center justify-between">
                <div class="px-4">
                    <a href="#home" class="block py-6 text-sm font-bold sm:text-base text-color4">
                        <img class="w-8 inline mr-4" src="/img/logoPssi.png">Program Pelatihan Atlit
                    </a>
                </div>
                <div class="flex items-center px-4">
                    <button id="hamburger" name="hamburger" type="button" class="absolute right-4 block lg:hidden">
                        <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out"></span>
                        <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
                    </button>

                    <nav id="nav-menu" class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-black py-5 shadow-lg lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none lg:dark:bg-transparent">
                        <ul class="block lg:flex">
                            <li class="group border-b-2 border-color5 border-opacity-0 hover:border-opacity-100 hover:text-color5 duration-200 cursor-pointer">
                                <a href="/" class="mx-8 flex py-2 text-base text-color4 group-hover:text-color5 dark:text-color4 {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                            </li>
                            <li class="group border-b-2 border-color5 border-opacity-0 hover:border-opacity-100 hover:text-color5 duration-200 cursor-pointer">
                                <a href="/pelatihan" class="mx-8 flex py-2 text-base text-color4 group-hover:text-color5 dark:text-color4 {{ request()->is('pelatihan') ? 'active' : '' }}">Pelatihan Atlit</a>
                            </li>
                            <li class="group border-b-2 border-color5 border-opacity-0 hover:border-opacity-100 hover:text-color5 duration-200 cursor-pointer">
                                <a href="/datapemain" class="mx-8 flex py-2 text-base text-color4 group-hover:text-color5 dark:text-color4 {{ request()->is('datapemain') ? 'active' : '' }}">Data Atlit</a>
                            </li>
                        </ul>
                    </nav>
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

                        <div class="relative mb-10 w-full">
                            <img src="/img/DavidDasilva.png" alt="w" class="mb-4">
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-lg px-8 py-8 relative mb-10 sm:w-1/2">
                        <h1 class="mx-auto text-center font-semibold mb-2"> Statistik Pemain</h1>
                        <h2><b>Nama Pemain :</b> {{ $statistik->title }}</h2>
                        <h2><b>Role Pemain :</b> {{ $statistik->rolepemain }}</h2>

                        <h3><b>Speed : </b>{{ $statistik->speed }} /100</h3>
                        <div class="w-64 mb-4 bg-color4 box-border shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-blue-600 text-white py-0.5 text-center" id="skillBar" style="width: 0;">0%</div>
                        </div>

                        <h3><b>Dribble :</b>{{ $statistik->dribble }} /100</h3>
                        <div class="w-64 mb-4 bg-color4 box-border shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-blue-600 text-white py-0.5 text-center" id="skillBar1" style="width: 0;">0%</div>
                        </div>

                        <h3><b>Passing Accuracy :</b>{{ $statistik->passing }} /100</h3>
                        <div class="w-64 mb-4 bg-color4 box-border shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-blue-600 text-white py-0.5 text-center" id="skillBar2" style="width: 0;">0%</div>
                        </div>

                        <h3><b>Tackles :</b>{{ $statistik->tackles }} /100</h3>
                        <div class="w-64 mb-4 bg-color4 box-border shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-blue-600 text-white py-0.5 text-center" id="skillBar3" style="width: 0;">0%</div>
                        </div>

                        <h3><b>durability :</b>{{ $statistik->durability }} /100</h3>
                        <div class="w-64 mb-4 bg-color4 box-border shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-blue-600 text-white py-0.5 text-center" id="skillBar4" style="width: 0;">0%</div>
                        </div>

                        <p class="text-left lg:text-sm"></p>
                    </div>
                </div>
            </div>
            <div class=" mx-auto items-center text-center">
                <a href="/datapemain" class="text-base font-semibold text-white bg-color5 py-2 px-4 rounded-lg 
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
        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = {
                {
                    $statistik - > speed
                }
            };
            let skillBar = document.getElementById('skillBar');
            skillBar.style.transition = 'width 2s ease-in-out';
            skillBar.style.width = nilaiKet + '%';
            skillBar.innerText = nilaiKet + '%';
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = {
                {
                    $statistik - > dribble
                }
            };
            let skillBar1 = document.getElementById('skillBar1');
            skillBar1.style.transition = 'width 2s ease-in-out';
            skillBar1.style.width = nilaiKet + '%';
            skillBar1.innerText = nilaiKet + '%';
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = {
                {
                    $statistik - > passing
                }
            };
            let skillBar2 = document.getElementById('skillBar2');
            skillBar2.style.transition = 'width 2s ease-in-out';
            skillBar2.style.width = nilaiKet + '%';
            skillBar2.innerText = nilaiKet + '%';
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = {
                {
                    $statistik - > tackles
                }
            };
            let skillBar3 = document.getElementById('skillBar3');
            skillBar3.style.transition = 'width 2s ease-in-out';
            skillBar3.style.width = nilaiKet + '%';
            skillBar3.innerText = nilaiKet + '%';
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            let nilaiKet = {
                {
                    $statistik - > durability
                }
            };
            let skillBar4 = document.getElementById('skillBar4');
            skillBar4.style.transition = 'width 2s ease-in-out';
            skillBar4.style.width = nilaiKet + '%';
            skillBar4.innerText = nilaiKet + '%';
        });
    </script>
</body>

</html>