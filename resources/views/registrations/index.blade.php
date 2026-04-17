<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">
            My Registrations
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($registrations as $registration)

            <!-- <div class="border rounded p-4 mb-4">

                <h2 class="text-xl font-bold">
                    {{ $registration->event->title }}
                </h2>

                <p>{{ $registration->event->location }}</p>
                <p>{{ $registration->event->date }}</p>

                <form action="{{ route('events.cancel', $registration->event->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')

                    <button class="px-4 py-2 bg-red-600 text-white rounded">
                        Cancel Participation
                    </button>
                </form>

            </div> -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-xl transition duration-300">

                @if($registration->event->image)
                <img src="{{ asset('storage/' . $registration->event->image) }}" class="w-full h-48 object-cover">
                @else
                <img src="{{ asset('assets/img/no-image.jpg') }}" class="w-full h-48 object-cover">
                @endif

                <div class="p-4">


                    <h3 class="text-xl font-bold">
                        {{ $registration->event->title }}
                    </h3>

                    <p class="text-gray-500 mb-1">
                        {{ \Carbon\Carbon::parse($registration->event->date)->format('d M Y') }}
                    </p>

                    @if($registration->event->category)
                    <span class="px-2 py-1 mb-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                        {{ $registration->event->category->name }}
                    </span>
                    @endif
                    <br>
                    <div class="flex">
                        <a href="{{ route('events.show', $registration->event->id) }}"
                            class="inline-block px-4 py-2 mt-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                            View Details
                        </a>
                        <form action="{{ route('events.cancel', $registration->event->id) }}" method="POST"
                            class="mt-3 ml-3">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 bg-red-600 text-white rounded">
                                Cancel Participation
                            </button>
                        </form>
                    </div>


                </div>

            </div>

            @empty
            <p>You have not joined any events yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>