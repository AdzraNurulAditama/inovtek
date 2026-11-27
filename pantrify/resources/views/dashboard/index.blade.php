@extends('layouts.app')

@section('title', 'Dashboard Pantrify')

@section('content')
@php
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');
    $level = $persen >= 90 ? 'danger' : ($persen >= 70 ? 'warning' : 'success');
    $sisaAnggaran = $anggaran - $terpakai;
    $jumlahNotif = count($stokMenipis);
@endphp

<style>
    .pantry-dashboard-container {
        padding-top: 0.5rem;
    }
    .pantry-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
    }
    .pantry-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    .hero-banner {
        background: #0f172a;
        color: #ffffff;
        border-radius: 1.25rem;
        overflow: hidden;
        border: none;
    }
    .icon-box {
        width: 42px; height: 42px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0.75rem;
        font-size: 1.15rem;
    }
    .custom-progress {
        height: 8px;
        border-radius: 999px;
        background-color: #f1f5f9;
        overflow: hidden;
    }
    .list-group-clean .list-group-item {
        border-color: #f1f5f9;
        padding-left: 0;
        padding-right: 0;
    }
    .list-group-clean .list-group-item:last-child {
        border-bottom: none;
    }
</style>

<div class="container-fluid pantry-dashboard-container px-0">
    
    {{-- Header Atas: Judul + Notifikasi Bahan/Stok + Profil --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-0">Dashboard</h1>
            <p class="text-muted small mb-0">Ringkasan dapur dan anggaranmu hari ini</p>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            {{-- Dropdown Notifikasi Bahan & Stok --}}
            <div class="dropdown">
                <button class="btn btn-white bg-white border rounded-circle position-relative p-2 shadow-sm" 
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi Stok">
                    <i class="bi bi-bell text-dark"></i>
                    @if($jumlahNotif > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                            {{ $jumlahNotif }}
                        </span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-3" style="width: 300px;">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                        <span class="fw-bold small text-dark">Notifikasi Stok & Bahan</span>
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill small">{{ $jumlahNotif }} Baru</span>
                    </div>
                    @forelse($stokMenipis as $notif)
                        <a href="{{ route('stok-dapur') }}" class="dropdown-item rounded-3 py-2 px-2 d-flex align-items-start gap-2 text-wrap">
                            <span class="rounded-circle bg-{{ $notif['status'] }} mt-1 flex-shrink-0" style="width:8px;height:8px"></span>
                            <div class="small">
                                <div class="fw-semibold text-dark">{{ $notif['nama'] }} ({{ $notif['sisa'] }})</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $notif['catatan'] ?? 'Stok menipis, segera beli ulang' }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-3 text-muted small">Tidak ada notifikasi stok baru.</div>
                    @endforelse
                </div>
            </div>

            {{-- Badge Profil --}}
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold small">
                <i class="bi bi-person-fill me-1"></i> {{ auth()->user()->name ?? 'Jroy' }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        
        {{-- Kolom Kiri (Utama) --}}
        <div class="col-12 col-xl-8">
            
            {{-- 1. Menu Makanan Hari Ini --}}
            <div class="card hero-banner mb-4">
                <div class="row g-0 align-items-center">
                    <div class="col-md-7 p-4">
                        <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-1 small fw-semibold mb-2">
                            <i class="bi bi-stars me-1"></i> Menu Makanan Hari Ini
                        </span>
                        <h2 class="fw-bold mb-2 text-white fs-3">{{ $menuHariIni['nama'] }}</h2>
                        <p class="text-white-50 small mb-3">
                            Estimasi biaya: <strong class="text-white">{{ $rp($menuHariIni['biaya']) }}</strong> &bull; <i class="bi bi-clock me-1"></i>{{ $menuHariIni['waktu'] }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('meal-planner') }}" class="btn btn-success fw-semibold rounded-pill px-4 py-2 text-white small">
                                Lihat Resep
                            </a>
                            <a href="{{ route('meal-planner') }}" class="btn btn-outline-light fw-semibold rounded-pill px-3 py-2 small">
                                Ganti Menu
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center p-3">
                        <div class="text-center text-white-50 p-3 rounded-4 bg-white bg-opacity-10 w-100">
                            <i class="bi bi-egg-fried display-4 text-warning mb-1"></i>
                            <div class="small fw-medium">Menu Siap Dimasak</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Baris 3 Kartu Ringkasan: Sisa Anggaran, Ringkasan Anggaran Mingguan, Ringkasan Stok Dapur --}}
            <div class="row g-3 mb-4">
                
                {{-- 2. Sisa Anggaran --}}
                <div class="col-12 col-md-4">
                    <div class="card pantry-card h-100">
                        <div class="card-body p-3 p-lg-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-secondary small fw-medium">Sisa Anggaran</span>
                                <div class="icon-box bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="fs-4 fw-bold {{ $sisaAnggaran < 0 ? 'text-danger' : 'text-dark' }} mb-1">
                                    {{ $rp($sisaAnggaran) }}
                                </h3>
                                <p class="text-muted small mb-0">
                                    {{ $sisaAnggaran < 0 ? 'Melebihi batas mingguan' : 'Aman untuk belanja' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Ringkasan Anggaran Mingguan --}}
                <div class="col-12 col-md-4">
                    <div class="card pantry-card h-100">
                        <div class="card-body p-3 p-lg-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-secondary small fw-medium">Anggaran Mingguan</span>
                                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between align-items-baseline mb-1">
                                    <h3 class="fs-5 fw-bold text-dark mb-0">{{ $rp($terpakai) }}</h3>
                                    <span class="small text-muted">/ {{ $rp($anggaran) }}</span>
                                </div>
                                <div class="custom-progress my-2">
                                    <div class="progress-bar bg-{{ $level }} rounded-pill" style="width: {{ min($persen, 100) }}%"></div>
                                </div>
                                <div class="d-flex justify-content-between small text-secondary">
                                    <span>Terpakai {{ $persen }}%</span>
                                    <a href="{{ route('anggaran') }}" class="fw-semibold text-primary text-decoration-none">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. Ringkasan Stok Dapur --}}
                <div class="col-12 col-md-4">
                    <div class="card pantry-card h-100">
                        <div class="card-body p-3 p-lg-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-secondary small fw-medium">Ringkasan Stok</span>
                                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="fs-4 fw-bold text-dark mb-1">{{ $totalStok }} <span class="fs-6 fw-normal text-muted">Item</span></h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-warning fw-medium small">{{ $jumlahNotif }} menipis</span>
                                    <a href="{{ route('stok-dapur') }}" class="small fw-semibold text-dark text-decoration-none">
                                        Kelola <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Scan Struk Banner --}}
            <div class="card pantry-card bg-light border-0">
                <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box bg-white border text-dark shadow-sm flex-shrink-0">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div>
                            <h4 class="h6 fw-bold text-dark mb-1">Baru Selesai Belanja?</h4>
                            <p class="small text-muted mb-0">Foto struk belanjamu untuk memperbarui stok & anggaran otomatis.</p>
                        </div>
                    </div>
                    <a href="{{ route('scan-struk') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold small flex-shrink-0">
                        Scan Struk <i class="bi bi-camera ms-1"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan (Notifikasi Bahan/Stok & Tips AI) --}}
        <div class="col-12 col-xl-4">
            
            {{-- 5. Notifikasi Bahan atau Stok --}}
            <div class="card pantry-card mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="h6 fw-bold text-dark mb-0">Notifikasi Bahan & Stok</h3>
                            @if($jumlahNotif > 0)
                                <span class="badge bg-danger rounded-pill" style="font-size: 0.7rem;">{{ $jumlahNotif }}</span>
                            @endif
                        </div>
                        <a href="{{ route('stok-dapur') }}" class="small fw-semibold text-success text-decoration-none">Semua</a>
                    </div>

                    @if($jumlahNotif > 0)
                        <ul class="list-group list-group-flush list-group-clean">
                            @foreach ($stokMenipis as $item)
                                <li class="list-group-item d-flex align-items-center justify-content-between py-2.5">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="rounded-circle bg-{{ $item['status'] }} flex-shrink-0" style="width:8px;height:8px"></span>
                                        <div>
                                            <span class="fw-medium text-dark small d-block">{{ $item['nama'] }}</span>
                                            <span class="text-muted" style="font-size: 0.72rem;">{{ $item['catatan'] ?? 'Stok menipis' }}</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-light text-secondary border fw-normal rounded-pill px-2.5 py-1" style="font-size: 0.75rem;">
                                        {{ $item['sisa'] }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                            Semua stok bahan dapur aman!
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tips AI --}}
            <div class="card pantry-card border-0" style="background: #f8fafc;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="icon-box bg-success bg-opacity-10 text-success" style="width: 32px; height: 32px; font-size: 1rem;">
                            <i class="bi bi-stars"></i>
                        </div>
                        <span class="small fw-bold text-success text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tips AI Pantrify</span>
                    </div>
                    <p class="mb-0 text-dark small lh-base">{{ $tipAi }}</p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection