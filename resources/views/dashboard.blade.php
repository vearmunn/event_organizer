<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2> -->
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Selamat Datang, {{ auth()->user()->name }}
            </h1>
            <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded">
                Buat Event
            </a>

        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex gap-3 mb-6">

                        <input type="text" name="search" placeholder="Cari event..." value="{{ request('search') }}"
                            class="border rounded px-3 py-2 w-full">

                        <select name="category_id" class="border rounded pr-10 py-2">

                            <option value="">Semua Kategori</option>

                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Filter
                        </button>

                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Reset
                        </a>

                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach ($events as $event)

                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-xl transition duration-300">

                            @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-48 object-cover">
                            @else
                            <img src="{{ asset('assets/img/no-image.jpg') }}" class="w-full h-48 object-cover">
                            @endif

                            <div class="p-4">


                                <h3 class="text-xl font-bold">
                                    {{ $event->title }}
                                </h3>

                                <p class="text-gray-500 mb-1">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                </p>

                                @if($event->category)
                                <span
                                    class="px-2 py-1 mb-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                    {{ $event->category->name }}
                                </span>
                                @endif
                                <br>
                                <a href="{{ route('events.show', $event->id) }}"
                                    class="inline-block px-4 py-2 mt-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Lihat Event
                                </a>

                            </div>

                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>