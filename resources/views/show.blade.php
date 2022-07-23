@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="/img/sonic.jpg" alt="Sonic" class="w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">Sonic</h2>
                <div class="flex flex-wrap itens-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current text-green-500 w-4" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="ml-1">85%</span>
                    <span class="mx-2">|</span>
                    <span>Feb 20, 2020</span>
                    <span class="mx-2">|</span>
                    <span>Comedia</span>
                </div>
                <p class="text-gray-300 mt-8">
                    Sonic, o ouriço azul mais veloz do mundo, vive isolado e sem amigos na Terra desde que precisou fugir de seu planeta natal. Todavia, ele recebe a ajuda de um policial quando o Dr. Ivo Robotinik, a mando do governo dos Estados Unidos, começa a persegui-lo.
                </p>
                <div class="mt-12">
                    <div class="flex mt-4">
                        <div>
                            <div>Yuji Naka</div>
                            <div class="text-sm text-gray-400">Characters</div>
                        </div>
                        <div class="ml-8">
                            <div>Hirokazu Yasuhara</div>
                            <div class="text-sm text-gray-400">Characters</div>
                        </div>
                        <div class="ml-8">
                            <div>Naoto Oshima</div>
                            <div class="text-sm text-gray-400">Characters</div>
                        </div>
                        <div class="ml-8">
                            <div>Jeff Fowler</div>
                            <div class="text-sm text-gray-400">Director</div>
                        </div>
                        <div class="ml-8">
                            <div>Josh Miller</div>
                            <div class="text-sm text-gray-400">Screenplay</div>
                        </div>
                        <div class="ml-8">
                            <div>Patrick Casey</div>
                            <div class="text-sm text-gray-400">Screenplay</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="movie-cast border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-white font-semibold">Elenco Principal</h2><div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                    <div class="mt-8">
                        <a href="#">
                            <img src="img/actor1.jpg" alt="actor" class="hover:opacity-75 transition ease-in-out duration-1">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">Papel</a>
                            <div class="text-gray-400 text-sm">
                                ator
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="#">
                            <img src="img/actor1.jpg" alt="actor" class="hover:opacity-75 transition ease-in-out duration-1">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">Papel</a>
                            <div class="text-gray-400 text-sm">
                                ator
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="#">
                            <img src="img/actor1.jpg" alt="actor" class="hover:opacity-75 transition ease-in-out duration-1">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">Papel</a>
                            <div class="text-gray-400 text-sm">
                                ator
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="#">
                            <img src="img/actor1.jpg" alt="actor" class="hover:opacity-75 transition ease-in-out duration-1">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">Papel</a>
                            <div class="text-gray-400 text-sm">
                                ator
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="#">
                            <img src="img/actor1.jpg" alt="actor" class="hover:opacity-75 transition ease-in-out duration-1">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">Papel</a>
                            <div class="text-gray-400 text-sm">
                                ator
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
