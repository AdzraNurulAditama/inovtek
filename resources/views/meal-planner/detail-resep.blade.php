@extends('layouts.app')

@section('title', $detail['nama'] . ' - Detail Resep Pantrify')

@section('content')
<style>
    .pantry-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
    }
</style>

<div class="container-fluid px-0" style="max-width: 800px;">
    
    {{-- Tombol Kembali --}}
    <div class="mb-3">
        <a href="{{ route('meal-planner') }}" class="btn btn-outline-secondary rounded-pill px-3 py-1.5 small fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Meal Planner
        </a>
    </div>

    {{-- Kartu Utama Detail Resep --}}
    <div class="card pantry-card mb-4">
        <div class="card-body p-4 p-lg-5">
            
            <div class="mb-3">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small fw-semibold mb-2">
                    {{ $detail['waktu'] }}
                </span>
                <h1 class="h3 fw-bold text-dark mb-3">{{ $detail['nama'] }}</h1>
                
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                        <i class="bi bi-tag-fill text-success me-1"></i> Estimasi: <strong>{{ $detail['biaya'] }}</strong>
                    </span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                        <i class="bi bi-fire text-danger me-1"></i> {{ $detail['kalori'] }}
                    </span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                        <i class="bi bi-egg-fried text-warning me-1"></i> Protein: {{ $detail['protein'] }}
                    </span>
                </div>
            </div>

            <hr class="text-muted opacity-25 mb-4">

            {{-- Bahan-bahan --}}
            <div class="mb-4">
                <h2 class="h6 fw-bold text-dark mb-3">
                    <i class="bi bi-basket text-success me-2"></i> Bahan-bahan yang Dibutuhkan:
                </h2>
                <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                    @foreach($detail['bahan'] as $bahan)
                        <li class="list-group-item bg-light py-2.5 px-3 small text-secondary">
                            <i class="bi bi-check2 text-success me-2"></i> {{ $bahan }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Cara Memasak --}}
            <div>
                <h2 class="h6 fw-bold text-dark mb-3">
                    <i class="bi bi-journal-text text-primary me-2"></i> Langkah-langkah Memasak:
                </h2>
                <div class="d-flex flex-column gap-2">
                    @foreach($detail['instruksi'] as $index => $langkah)
                        <div class="p-3 bg-light rounded-3 d-flex gap-3 align-items-start">
                            <span class="badge bg-dark rounded-circle px-2 py-1 small">{{ $index + 1 }}</span>
                            <p class="small text-secondary mb-0 lh-base">{{ $langkah }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>
@endsection