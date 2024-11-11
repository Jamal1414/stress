@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Manajemen Postingan</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-2">Buat Postingan Baru</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">KATEGORI</th>
                <th scope="col">MEDIA</th>
                <th scope="col">JUDUL</th>
                <th scope="col">KONTEN</th>
                <th scope="col">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{ $post->category->name }}</td>
                <td class="text-center">
                    @if(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif']))
                        <img src="{{ asset('/storage/posts/'.$post->media) }}" class="rounded" style="width: 150px">
                    @elseif(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                        <video width="150" height="auto" controls>
                            <source src="{{ asset('/storage/posts/'.$post->media) }}" type="video/{{ pathinfo($post->media, PATHINFO_EXTENSION) }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{!! $post->content !!}</td>
                <td class="text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">SHOW</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary" style="margin-left: 5px;">EDIT</a>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" style="margin-left: 5px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Data Post belum Tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $posts->links() }}
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

<script>
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!'); 
    @endif
</script>
@endsection
