<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Event Saya</h1>

                        <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Buat Event
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($events as $event)

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
                        @empty
                        <p>No events created yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>