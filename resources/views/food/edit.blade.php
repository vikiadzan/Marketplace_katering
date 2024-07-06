@extends('layout.app')
@section('title', 'Edit Makanan')
@section('content')
<a href="/food" class="btn btn-secondary"> kembali</a>
<form method="post" action="{{ '/food/'.$data->id }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
      <label for="name" class="form-label">Nama Makanan</label>
      <input type="text" class="form-control" name="name"  id="name"value="{{ $data->name}}" required >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ $data->description }}</textarea>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <input type="file" class="form-control" name="image" id="image" value="{{ $data->image}}" required>
    </div>
  
    <div class="mb-3">
      <label for="harga" class="form-label">harga</label>
      <input type="number" class="form-control" name="harga"  id="harga" value="{{ $data->harga}}" required>
    </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection