@extends('layout/app')
@section('title', 'Data Makanan')
@section('content')
<form method="post" action="/food" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama Makanan</label>
      <input type="text" class="form-control" name="name"  id="name" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" placeholder="description" class="form-control" id="" cols="30" rows="10" required></textarea>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <input type="file" class="form-control" name="image" id="image" required>
    </div>
  
    <div class="mb-3">
      <label for="harga" class="form-label">harga</label>
      <input type="number" class="form-control" name="harga"  id="harga" required>
    </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection