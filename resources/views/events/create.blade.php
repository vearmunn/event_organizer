<x-app-layout>
    <div class="max-w-xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">Buat Event</h1>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Lokasi</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" required>
            </div>

            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Pilih Kategori</option>

                @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <div class="mb-4">
                <label class="block mb-1">Tanggal</label>
                <input type="date" name="date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Pilih Gambar</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan Event
            </button>

        </form>

    </div>
</x-app-layout>