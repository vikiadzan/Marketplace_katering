@extends('layout.app')

@section('title', 'Data Makanan')

@section('content')
    <a href="/food/create" class="btn btn-primary">Tambah Data</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->description}}</td>
                    <td>{{ $item->harga}}</td>
                    <td><img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" width="200" height="auto"></td>
                    <td><a class="btn btn-warning btn-sm" href="{{url('/food/'. $item->id.'/edit')}}">Edit</a></td>
                    <td>
                        <form class="d-inlane" action="{{ '/food/'.$item->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="button" onclick="confirmDelete('{{ $item->id }}')">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links()}}

    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                // Submit form
                document.querySelector('form[action="/food/' + id + '"]').submit();
            }
        }
    </script>
@endsection