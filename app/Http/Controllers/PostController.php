<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; 

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        // Ambil semua kategori untuk ditampilkan di dropdown
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'media'     => 'required|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:10000',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $media = $request->file('media');
        $media->storeAs('public/posts', $media->hashName());

        Post::create([
            'media'     => $media->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
            'category_id' => $request->category_id, // Simpan kategori yang dipilih
        ]);

        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function edit(string $id): View
    {
        // Get post by ID
        $post = Post::findOrFail($id);
    
        // Get all categories
        $categories = Category::all();
    
        // Render view with post and categories
        return view('posts.edit', compact('post', 'categories'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'media'     => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:10000', // Boleh kosong
            'title'     => 'required|min:5',
            'content'   => 'required|min:10',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $media->storeAs('public/posts', $media->hashName());
            Storage::delete('public/posts/'.$post->media);
            $post->update([
                'media'     => $media->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
                'category_id' => $request->category_id, // Simpan kategori yang dipilih
            ]);
        } else {
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'category_id' => $request->category_id, // Simpan kategori yang dipilih
            ]);
        }

        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        Storage::delete('public/posts/'. $post->media);
        $post->delete();
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
