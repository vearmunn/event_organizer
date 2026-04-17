<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-md overflow-hidden border">

            {{-- Event Image --}}
            @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-100 object-cover">
            @else
            <img src="{{ asset('assets/img/no-image.jpg') }}" class="w-full h-100 object-cover">
            @endif

            <div class="p-6">

                {{-- Title + Category --}}
                <div class="flex items-center justify-between gap-3 mb-4">
                    <h1 class="text-3xl font-bold text-gray-800">
                        {{ $event->title }}
                    </h1>

                    @if($event->category)
                    <span class="px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-700 rounded-full">
                        {{ $event->category->name }}
                    </span>
                    @endif
                </div>

                {{-- Event Info --}}
                <div class="space-y-2 text-gray-600 mb-6">
                    <p>
                        <span class="font-semibold">Date:</span>
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                    </p>

                    <p>
                        <span class="font-semibold">Location:</span>
                        {{ $event->location }}
                    </p>
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">
                        Description
                    </h2>

                    <p class="text-gray-700 leading-relaxed">
                        {{ $event->description ?: 'No description available.' }}
                    </p>
                </div>

                @php
                $joined = \App\Models\Registration::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();
                @endphp

                {{-- Action Buttons --}}
                <div class="flex flex-wrap gap-3">

                    {{-- Other Users --}}
                    @if($event->organizer_id != auth()->id())

                    @if(!$joined)
                    <form action="{{ route('events.join', $event->id) }}" method="POST">
                        @csrf
                        <button class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Join Event
                        </button>
                    </form>
                    @else
                    <form action="{{ route('events.cancel', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Cancel Participation
                        </button>
                    </form>
                    @endif

                    @endif

                    {{-- Owner --}}
                    @if($event->organizer_id == auth()->id())

                    <a href="{{ route('events.edit', $event->id) }}"
                        class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Edit
                    </a>

                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Delete
                        </button>
                    </form>

                    @endif

                    <!-- <a href="{{ route('dashboard') }}"
                        class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Back
                    </a> -->

                </div>

            </div>
        </div>

    </div>
</x-app-layout>