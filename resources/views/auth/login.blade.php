@extends('layouts.app')

@section('content')

    <div class="py-12 bg-gray-700  mt-auto mx-auto w-11/12 md:w-2/3 max-w-lg shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>

      <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
        Username
      </label>

                <input id="email" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">

      <label class="block text-grey-darker-900 text-sm font-bold mb-2" for="Password">
        Password
      </label>

                <input id="password" class="block mt-1 w-full bg-gray-800 px-4 focus:outline-none focus:shadow-outline"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>



            <div class="flex items-center justify-end mt-4">

                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">
                    {{ __('Log in') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="focus:outline-none focus:ring-2 ml-4 focus:ring-offset-2 focus:ring-yellow-700 transition duration-150 ease-in-out hover:bg-yellow-600 bg-yellow-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm" href="{{ route('register') }}">
                        {{ __('Cadastre-se') }}
                    </a>
                @endif

            </div>
        </form>


    </div>
@endsection
