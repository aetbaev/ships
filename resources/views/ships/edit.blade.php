@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Редактирование</h2>
        <a href="{{ route('ships.index') }}"
           class="inline-flex items-center text-sm font-medium px-3 py-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>
            Назад к списку лайнеров
        </a>
    </div>

    <form action="{{ route('ships.update', $ship) }}" method="POST">
        @csrf
        @method('PUT')
        @include('ships._form')

        <div class="p-4 flex justify-between">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Сохранить
            </button>
            <a href="{{ route('ships.index') }}"
               class="text-sm w-full sm:w-auto font-medium px-5 py-2.5 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Отмена
            </a>
        </div>
    </form>
@endsection
