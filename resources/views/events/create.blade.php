<x-app-layout>
    <div class="max-w-xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">Create Event</h1>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Location</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" required>
            </div>

            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Category</option>

                @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <div class="mb-4">
                <label class="block mb-1">Date</label>
                <input type="date" name="date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Event Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Save Event
            </button>

        </form>

    </div>
</x-app-layout>