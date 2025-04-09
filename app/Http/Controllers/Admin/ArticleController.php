<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Tampilkan daftar artikel (sementara redirect ke dashboard)
    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    // Tampilkan form tambah artikel
    public function create()
    {
        return view('admin.articles.create');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['author'] = auth()->user()->name ?? 'Admin';

        Article::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil ditambahkan.');
    }

    // Tampilkan detail artikel
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.show', compact('article'));
    }

    // Tampilkan form edit artikel
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    // Update artikel
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil diperbarui.');
    }

    // Hapus artikel
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil dihapus.');
    }

    // Upload gambar dari CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => asset('storage/' . $path),
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'Upload gagal']
        ]);
    }
}
