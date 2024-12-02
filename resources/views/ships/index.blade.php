@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Список лайнеров</h2>
        <a href="{{ route('ships.create') }}"
           class="inline-flex items-center text-sm font-medium px-3 py-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14m-7 7V5"/>
            </svg>
            Новый лайнер
        </a>
    </div>

    @session('success')
    <div class="p-4 my-4 text-sm font-medium text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        {{ $value }}
    </div>
    @endsession

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @foreach($ships as $ship)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="relative h-48">
                    @if ($ship->gallery->count())
                        <img src="{{$ship->gallery->first()->url}}"
                             class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-900">{{ $ship->title }}</h3>
                    <div class="mt-4">
                        <form
                            onsubmit="return confirm('Удалить запись?');"
                            action="{{ route('ships.destroy',$ship) }}"
                            method="POST"
                            class="flex justify-between">
                            @csrf
                            @method('DELETE')
                            <a
                                href="{{ route('ships.edit', $ship) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-medium py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                Редактировать
                            </a>
                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-700 text-sm text-white font-medium py-1 px-2 rounded focus:outline-none focus:shadow-outline ml-2">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
