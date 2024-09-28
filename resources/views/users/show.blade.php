@extends('app')

@section('content')
    <div class="flex justify-center items-center min-h-screen flex-col">
        <div
            class="block max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                ID : {{ $user->id }}
            </h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Name : {{ $user->name }}
            </h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Email : {{ $user->email }}
            </h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Created at : {{ $user->created_at->format('F j, Y g:i A') }}
            </h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Updated at : {{ $user->updated_at->format('F j, Y g:i A') }}
            </h5>
        </div>
    </div>
@endsection
