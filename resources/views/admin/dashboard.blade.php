@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-700">Daftar Artikel</h2>
    <a href="{{ route('admin.articles.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah Artikel
    </a>
</div>

@if ($articles->count())
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($articles as $article)
                    <tr>
                        <td class="px-6 py-4">{{ $article->title }}</td>
                        <td class="px-6 py-4">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.articles.show', $article->id) }}"
                               class="text-green-600 hover:underline">Lihat</a>

                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-gray-500">Belum ada artikel.</p>
@endif
@endsection

