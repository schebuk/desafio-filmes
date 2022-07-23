<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="widht=device-width, initial-scale=1">
    <title>Teste Filmes</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="fint-sans bg-gray-900 text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="/filmes" class="hover:text-gray-300">Todos os Filmes</a>
                </li>
                <li class="md:ml-6">
                    <a href="/favoritos" class="hover:text-gray-300">Favoritos</a>
                </li>
                <li class="md:ml-6">
                    <a href="/importgenre" class="hover:text-gray-300">Importar Generos</a>
                </li>
                <li class="md:ml-6">
                    <a href="/import" class="hover:text-gray-300">Importar Filmes</a>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                <div class="relative">
                    <input type="text" class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline " placeholder="Procurar">
                    <div class="absolute top-0">
                        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="md:ml-4 mt-4 md:mt-0 mr-4">
                    {{ Auth::user()->name }}
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
