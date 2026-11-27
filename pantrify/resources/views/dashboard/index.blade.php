@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');
    $level = $persen >= 90 ? 'danger' : ($persen >= 70 ? 'warning' : 'ok');
@endphp

<div class="grid">

    {{-- Menu hari ini: elemen utama dashboard --}}
    <section class="card card--feature">
        <div class="feature__media" role="img" aria-label="Foto {{ $menuHariIni['nama'] }}">
            {{-- Ganti dengan: <img src="{{ asset('images/menu-hari-ini.jpg') }}" alt=""> --}}
            <i class="bi bi-image"></i>
        </div>
        <div class="feature__body">
            <p class="card__label">Menu hari ini</p>
            <h2 class="feature__title">{{ $menuHariIni['nama'] }}</h2>
            <p class="feature__meta">
                <span class="price">Estimasi {{ $rp($menuHariIni['biaya']) }}</span>
                <span class="muted"><i class="bi bi-clock"></i> {{ $menuHariIni['waktu'] }}</span>
            </p>
            <div class="feature__actions">
                <a href="{{ route('meal-planner') }}" class="btn btn--primary">Lihat resep</a>
                <a href="{{ route('meal-planner') }}" class="btn btn--ghost">Ganti menu</a>
            </div>
        </div>
    </section>

    {{-- Statistik --}}
    <section class="card stat">
        <p class="card__label">Anggaran</p>
        <p class="stat__value">{{ $rp($anggaran) }}</p>
        <p class="muted">Sisa {{ $rp($anggaran - $terpakai) }} minggu ini</p>
    </section>

    <section class="card stat">
        <p class="card__label">Stok bahan</p>
        <p class="stat__value">{{ $totalStok }}</p>
        <p class="muted">{{ count($stokMenipis) }} perlu perhatian</p>
    </section>

    {{-- Anggaran mingguan --}}
    <section class="card card--wide">
        <div class="card__head">
            <h3>Anggaran mingguan</h3>
            <a href="{{ route('anggaran') }}" class="link">Lihat detail</a>
        </div>
        <div class="progress progress--{{ $level }}" role="progressbar"
             aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100">
            <div class="progress__bar" style="width: {{ $persen }}%"></div>
        </div>
        <p class="progress__text">
            <strong>{{ $persen }}%</strong> telah digunakan
            <span class="muted">({{ $rp($terpakai) }} dari {{ $rp($anggaran) }})</span>
        </p>
    </section>

    {{-- Stok perlu perhatian --}}
    <section class="card card--wide">
        <div class="card__head">
            <h3>Stok perlu perhatian</h3>
            <a href="{{ route('stok-dapur') }}" class="link">Buka stok dapur</a>
        </div>
        <ul class="list">
            @foreach ($stokMenipis as $item)
                <li class="list__row">
                    <span class="status status--{{ $item['status'] }}"></span>
                    <span class="list__name">{{ $item['nama'] }}</span>
                    <span class="muted">{{ $item['catatan'] ?? 'Stok menipis' }}</span>
                    <span class="list__value">{{ $item['sisa'] }}</span>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- Scan struk (CTA oranye) + tip AI --}}
    <section class="card card--scan">
        <i class="bi bi-receipt"></i>
        <div>
            <h3>Baru belanja?</h3>
            <p>Foto struknya, stok dan anggaran terisi otomatis.</p>
        </div>
        <a href="{{ route('scan-struk') }}" class="btn btn--accent">Scan struk</a>
    </section>

    <section class="card card--tip">
        <p class="card__label"><i class="bi bi-stars"></i> Tips dari AI</p>
        <p>{{ $tipAi }}</p>
    </section>

</div>
@endsection