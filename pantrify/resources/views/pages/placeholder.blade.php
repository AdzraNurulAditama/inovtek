@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="card empty">
        <i class="bi bi-tools"></i>
        <h2>Halaman {{ $title }} belum dibuat</h2>
        <p class="muted">Buat controller dan view untuk halaman ini, lalu ganti route placeholder di routes/web.php.</p>
    </div>
@endsection