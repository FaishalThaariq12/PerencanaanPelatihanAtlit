<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vanila Css -->
    @vite('resources/css/app.css')
    <title>Program Pelatihan Atlit</title>
    <!-- AOS css animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="/img/png" href="/img/logoPssi.png">
    {{-- Bootsrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
</head>

<body>
    <section id="home" class="pt-36 pb-28 lg:pb-6 bg-white">

        <div class="flex flex-col justify-center">
            <img src="" alt="logo-Synchronize " class="mx-auto w-1/4 mb-8 -mt-24 md:w-52 lg:w-28">
            <h2 class="text-white text-center mx-auto font-semibold mb-6 md:text-3xl lg:text-xl"> Logo Synchronize </h2>
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="/login" method="post" class="max-w-[400px] w-full mx-auto bg-black shadow-xl p-8 px-8 rounded-lg">
                <h2 class="text-4xl text-white font-bold text-center">Sign In</h2>
                @csrf
                <div class="flex flex-col py-2">
                    <label for="email" class="text-white">User Name</label>
                    <input type="email" name="email" class=" form-control @error('email') is-invalid @enderror text-black rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-600 focus:bg-gray-200 focus:outline-none" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                </div>
                <div class="flex flex-col py-2">
                    <label for="password" class="text-white">Password</label>
                    <div class="relative">
                        <input id="password" placeholder="Password" type="password" name="password" class="text-black w-full rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-600 focus:bg-gray-200 focus:outline-none">
                    </div>
                    <div class="mt-5">
                        <input id="openpw" type="checkbox">
                        <label for="" class="text-white">show password</label>
                    </div>
                    <button class="text-white w-full my-5 py-2 font-semibold rounded-lg bg-yellow-600 hover:shadow-lg hover:shadow-green-600/50 ease-in-out duration-300">Sign In</button>
                    <div class=" mx-auto items-center text-center">
                        <a href="/" class="text-base font-semibold text-white bg-color5 py-2 px-4 rounded-lg 
                hover:shadow-lg hover:bg-white hover:text-color5 hover:opacity-80 transition duration-300 ease-in-out">
                            Kembali</a>
                    </div>
                </div>
            </form>

        </div>

    </section>

    <footer class="bg-black text-white text-xs sm:text-base text-center pt-4 pb-4 font-mono fixed bottom-0 w-full">
        © Copyright 2024 - <span class="text-yellow-600">Synchronize</span>
    </footer>

    <script>
        let openpw = document.getElementById("openpw");
        let password = document.getElementById("password");

        openpw.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>