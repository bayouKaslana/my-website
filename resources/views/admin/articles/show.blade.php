@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">{{ $article->title }}</h2>

    @if ($article->image)
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="mb-4 max-w-full h-auto rounded shadow">
    @endif

    <p class="text-gray-700 leading-relaxed">
        {!! nl2br(e($article->content)) !!}
    </p>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline">← Kembali ke Dashboard</a>
    </div>
@endsection
