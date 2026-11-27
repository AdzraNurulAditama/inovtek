@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="card text-center py-5">
        <div class="card-body">
            <i class="bi bi-tools fs-1 text-success"></i>
            <h2 class="h5 fw-bold mt-2">Halaman {{ $title }} belum dibuat</h2>
            <p class="text-secondary mb-0">Buat controller dan view untuk halaman ini, lalu ganti route placeholder di routes/web.php.</p>
        </div>
    </div>
@endsection