<x-app-layout>
    <div class="p-6 mr-4">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Events</h1>

            <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Create Event
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
            <!-- <div class="border rounded p-4 mb-4">

            <h2 class="text-xl font-bold">
                {{ $event->title }}
            </h2>

            <p>{{ $event->location }}</p>
            <p>{{ $event->date }}</p>

            <div class="mt-3 space-x-2">
                <a href="{{ route('events.edit', $event->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">
                    Edit
                </a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')

                    <button class="px-3 py-1 bg-red-600 text-white rounded">
                        Delete
                    </button>
                </form>
            </div>

        </div> -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-xl transition duration-300">

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
                    <span class="px-2 py-1 mb-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                        {{ $event->category->name }}
                    </span>
                    @endif
                    <br>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="inline-block px-4 py-2 mt-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                        View Details
                    </a>



                </div>

            </div>
            @empty
            <p>No events created yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>