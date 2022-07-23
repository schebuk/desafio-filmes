@extends('layouts.app')

@section('content')


<div class="py-12 bg-gray-700  mt-auto mx-auto w-11/12 md:w-2/3 max-w-lg shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-grey-darker-900 text-sm font-bold mb-2" for="name">Nome</label>

                <input id="name" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label class="block text-grey-darker-900 text-sm font-bold mb-2" for="email">E-mail</label>

                <input id="email" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block text-grey-darker-900 text-sm font-bold mb-2" for="password">Senha</label>

                <input id="password" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="block text-grey-darker-900 text-sm font-bold mb-2" for="password_confirmation">Confirme a senha</label>

                <input id="password_confirmation" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">
                    {{ __('Register') }}
                </button>
                <a class="focus:outline-none focus:ring-2 ml-4 focus:ring-offset-2 focus:ring-yellow-700 transition duration-150 ease-in-out hover:bg-yellow-600 bg-yellow-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </div>
        </form>
    </div>
@endsection
