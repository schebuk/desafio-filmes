@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="Filmes">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Filmes</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($filmes as $filme)
                    <div class="mt-8">
                        <div class="relative">
                            <a href="#">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $filme->poster_path }}" alt="{{ $filme->title }}" class="hover:opacity-75 transition ease-in-out duration-1">
                            </a>
                            <div class="absolute top-0 right-0">
                                <a href="/favorito/{{ $filme->id }}/{{ Auth::user()->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6
                                    @foreach ($favoritos as $favorito)
                                        @if ($filme->id == $favorito->filmeid)
                                            fill-current text-Yellow-900
                                        @endif
                                    @endforeach
                                    " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                </a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $filme->title }}</a>
                            <div class="flex itens-center text-gray-400 text-sm mt-1">
                                    <svg class="fill-current text-green-500 w-4" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                <span class="ml-1">{{ $filme->vote_average * 10}}%</span>
                                <span class="mx-2">|</span>
                                <span>{{ \Carbon\Carbon::parse($filme->release_date)->format('d/M/Y')}}</span>
                            </div>
                            <div class="text-gray-400 text-sm">
                                {{ $filme->genre_ids }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{ $filmes->links('pagination::tailwind') }}
@endsection
