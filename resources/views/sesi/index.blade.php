@extends('layout.app')

@section('title', 'Data Makanan')
@section('content')
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>login</h1>
        <form action="/user/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">EMail</label>
                <input type="email"  name ="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password"  name ="password" class="form-control">
            </div>

            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
@endsection