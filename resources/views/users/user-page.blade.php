@extends('app')

@section('content')
    <div class="grid flex-grow grid-cols-1 gap-3 mt-24 lg:grid-cols-3 place-items-center">
        @foreach ($scans as $scan)
            <div
                class="max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="p-3">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Date: {{ $scan->created_at->format('F j, Y') }}
                    </h5>
                    <h5 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">
                        Time in: {{ $scan->time_in ? $scan->time_in->format('g:i A') : 'Not Recorded' }}
                    </h5>
                    <h5 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">
                        Time out: {{ $scan->time_out ? $scan->time_out->format('g:i A') : 'Not Recorded' }}
                    </h5>
                </div>
            </div>
        @endforeach
    </div>
@endsection
