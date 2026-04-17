<x-app-layout>
    <div class="max-w-xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Edit Event</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="title" value="{{ $event->title }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label>Lokasi</label>
                <input type="text" name="location" value="{{ $event->location }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Kategori</label>

                <select name="category_id" class="w-full border rounded px-3 py-2">

                    <option value="">Pilih Kategori</option>

                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="date" value="{{ $event->date }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="description"
                    class="w-full border rounded px-3 py-2">{{ $event->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Gambar</label>

                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="w-48 rounded mb-2">
                @else
                <p>No image</p>
                @endif
            </div>

            <div class="mb-4">
                <label class="block mb-1">Ganti Gambar</label>
                <input type="file" name="image">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update Event
            </button>

        </form>
    </div>
</x-app-layout>