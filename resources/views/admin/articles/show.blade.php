@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $article->title }}</h2>

    @if($article->image)
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="mb-6 w-full rounded-lg">
    @endif

    <div class="prose max-w-none">
        {!! $article->content !!}
    </div>

    <div class="mt-6 text-sm text-gray-500">
        Ditulis oleh <span class="font-medium">{{ $article->author }}</span>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.articles.index') }}"
           class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
            &larr; Kembali ke Daftar Artikel
        </a>
    </div>
</div>
@endsection
