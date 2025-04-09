@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Edit Artikel</h2>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="title">Judul Artikel</label>
            <input type="text" name="title" id="title"
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring"
                   value="{{ old('title', $article->title) }}" required>
        </div>

        {{-- Konten --}}
        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="content">Konten</label>
            <textarea name="content" id="editor" rows="15" class="w-full h-[500px]">
                {!! old('content', $article->content) !!}
            </textarea>
        </div>

        {{-- Gambar Utama --}}
        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="image">Gambar Utama (opsional)</label>
            @if ($article->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel" class="h-40 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" id="image"
                   class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-600 hover:text-gray-900 px-4 py-2 border border-gray-300 rounded">
                Kembali
            </a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Perbarui Artikel
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route("admin.articles.upload") }}?&_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
