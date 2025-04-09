@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Tambah Artikel Baru</h2>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-1">Judul</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Konten --}}
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-semibold mb-1">Konten</label>
            <textarea name="content" id="content" rows="6" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-1">Gambar (opsional)</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
