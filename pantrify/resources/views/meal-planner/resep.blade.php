
@extends('layouts.app')

@section('title', request('nama', 'Detail Menu') . ' - Pantrify')

@section('content')

@php
    // Mengambil data dari parameter URL
    $nama = request('nama');
    abort_if(blank($nama), 404);

    $waktu = request('waktu', 'Menu');
    $biaya = request('biaya', '-');

    $angka = fn ($v) => (int) preg_replace('/\D/', '', (string) $v);

    $kalori = $angka(request('kalori'));
    $protein = $angka(request('protein'));

    $targetKalori = 1900;
    $targetProtein = 95;

    // Data resep
    $resep = [
        'Oatmeal Pisang & Telur Rebus' => [
            'bahan' => [
                'Oatmeal',
                'Pisang',
                'Telur'
            ],
            'instruksi' => 'Rebus telur selama 7 menit. Seduh oatmeal dengan air panas atau susu, lalu potong pisang di atasnya.',
        ],

        'Ayam Tumis Sayuran & Nasi Merah' => [
            'bahan' => [
                'Dada Ayam',
                'Wortel',
                'Brokoli',
                'Nasi Merah'
            ],
            'instruksi' => 'Tumis potongan dada ayam dengan bawang putih, masukkan sayuran, tambahkan sedikit kecap asin dan garam secukupnya.',
        ],

        'Sup Tahu Sutra & Brokoli' => [
            'bahan' => [
                'Tahu Sutra',
                'Brokoli',
                'Kaldu Ayam'
            ],
            'instruksi' => 'Didihkan air kaldu, masukkan potongan tahu sutra dan brokoli, bumbui dengan merica dan garam.',
        ],
    ];

    $detail = $resep[$nama] ?? [
        'bahan' => [],
        'instruksi' => ''
    ];

    $bahan = $detail['bahan'];

    $langkah = preg_split(
        '/(?<=\.)\s+/',
        trim($detail['instruksi']),
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    $persenKalori = min(100, round($kalori / $targetKalori * 100));
    $persenProtein = min(100, round($protein / $targetProtein * 100));
@endphp

<style>
    .pantry-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
    }

    .bahan-check:checked + label {
        text-decoration: line-through;
        color: #94a3b8;
    }

    .pantry-card h2 {
        color: #26352b;
    }

    .nutrition-progress {
        border-radius: 20px;
        overflow: hidden;
    }

    .bahan-check {
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
    }
</style>

<div class="container-fluid px-0">

    {{-- Kembali ke Meal Planner --}}
    <a href="{{ route('meal-planner') }}"
       class="btn btn-sm btn-outline-secondary rounded-pill px-3 mb-3">

        <i class="bi bi-arrow-left me-1"></i>
        Kembali ke Meal Planner

    </a>

    {{-- Judul dan Informasi Menu --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>

            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 mb-2">
                {{ $waktu }}
            </span>

            <h1 class="h4 fw-bold text-dark mb-1">
                {{ $nama }}
            </h1>

            <div class="d-flex flex-wrap gap-3 small text-muted">

                <span>
                    <i class="bi bi-fire text-danger me-1"></i>
                    <strong>{{ $kalori }}</strong> kkal
                </span>

                <span>
                    <i class="bi bi-egg-fried text-warning me-1"></i>
                    Protein <strong>{{ $protein }}g</strong>
                </span>

                <span>
                    <i class="bi bi-tag-fill text-success me-1"></i>
                    Estimasi <strong>{{ $biaya }}</strong>
                </span>

            </div>
        </div>

        <button
            type="button"
            id="tambah-belanja"
            class="btn btn-dark rounded-pill px-4 fw-semibold"
        >
            <i class="bi bi-basket me-1"></i>
            Tambah ke Daftar Belanja
        </button>

    </div>

    <div class="row g-4">

        {{-- Bahan-bahan --}}
        <div class="col-12 col-lg-5">

            <div class="card pantry-card h-100">

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Bahan-bahan
                    </h2>

                    @forelse($bahan as $i => $b)

                        <div class="form-check py-2 border-bottom">

                            <input
                                class="form-check-input bahan-check"
                                type="checkbox"
                                id="bahan-{{ $i }}"
                            >

                            <label
                                class="form-check-label"
                                for="bahan-{{ $i }}"
                            >
                                {{ $b }}
                            </label>

                        </div>

                    @empty

                        <p class="text-muted small mb-0">
                            Daftar bahan belum tersedia untuk menu ini.
                        </p>

                    @endforelse

                    @if(count($bahan))

                        <p class="text-muted small mt-3 mb-0">
                            Centang bahan yang sudah kamu punya.
                        </p>

                    @endif

                </div>

            </div>

        </div>

        {{-- Cara Memasak --}}
        <div class="col-12 col-lg-7">

            <div class="card pantry-card h-100">

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Cara Memasak
                    </h2>

                    @forelse($langkah as $s)

                        <div class="d-flex gap-3 mb-3">

                            <span
                                class="badge bg-dark rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:28px;height:28px;"
                            >
                                {{ $loop->iteration }}
                            </span>

                            <p class="mb-0">
                                {{ $s }}
                            </p>

                        </div>

                    @empty

                        <p class="text-muted small mb-0">
                            Langkah memasak belum tersedia untuk menu ini.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

        {{-- Informasi Gizi --}}
        <div class="col-12">

            <div class="card pantry-card">

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Informasi Gizi
                    </h2>

                    <div class="row g-4">

                        {{-- Kalori --}}
                        <div class="col-md-6">

                            <div class="d-flex justify-content-between small mb-1">

                                <span class="fw-semibold">
                                    Kalori
                                </span>

                                <span class="text-muted">
                                    {{ $kalori }} / {{ $targetKalori }} kkal
                                    ({{ $persenKalori }}%)
                                </span>

                            </div>

                            <div class="progress nutrition-progress" style="height:8px;">

                                <div
                                    class="progress-bar bg-danger"
                                    style="width: {{ $persenKalori }}%"
                                ></div>

                            </div>

                        </div>

                        {{-- Protein --}}
                        <div class="col-md-6">

                            <div class="d-flex justify-content-between small mb-1">

                                <span class="fw-semibold">
                                    Protein
                                </span>

                                <span class="text-muted">
                                    {{ $protein }} / {{ $targetProtein }} g
                                    ({{ $persenProtein }}%)
                                </span>

                            </div>

                            <div class="progress nutrition-progress" style="height:8px;">

                                <div
                                    class="progress-bar bg-warning"
                                    style="width: {{ $persenProtein }}%"
                                ></div>

                            </div>

                        </div>

                    </div>

                    <p class="text-muted small mt-3 mb-0">
                        Persentase dihitung dari target gizi harian.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- JavaScript Daftar Belanja --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const STORAGE_KEY = 'pantrify_daftar_belanja';

    const namaResep = @json($nama);
    const bahanResep = @json($bahan);

    // Estimasi harga setiap bahan
    const hargaBahan = {
        'Oatmeal': 5000,
        'Pisang': 3000,
        'Telur': 3000,
        'Dada Ayam': 10000,
        'Wortel': 2000,
        'Brokoli': 4000,
        'Nasi Merah': 3000,
        'Tahu Sutra': 4000,
        'Kaldu Ayam': 2000
    };

    const tombol = document.getElementById('tambah-belanja');

    if (!tombol) {
        return;
    }

    tombol.addEventListener('click', function () {

        let daftar = [];

        // Mengambil data daftar belanja
        try {
            daftar = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

            if (!Array.isArray(daftar)) {
                daftar = [];
            }

        } catch (error) {
            daftar = [];
        }

        // Mengambil hanya bahan yang belum dicentang
        const bahanBelumDimiliki = bahanResep.filter(function (namaBahan, index) {

            const checkbox = document.getElementById('bahan-' + index);

            return checkbox && !checkbox.checked;

        });

        // Jika semua bahan sudah dicentang
        if (bahanBelumDimiliki.length === 0) {

            alert('Semua bahan sudah kamu miliki. Tidak ada yang perlu dibeli!');

            return;
        }

        let jumlahDitambahkan = 0;

        // Menambahkan bahan yang belum dimiliki
        bahanBelumDimiliki.forEach(function (namaBahan) {

            // Memeriksa apakah bahan sudah ada di daftar belanja
            const sudahAda = daftar.some(function (item) {

                return item.name &&
                    item.name.toLowerCase() === namaBahan.toLowerCase();

            });

            // Jika belum ada, masukkan ke daftar belanja
            if (!sudahAda) {

                daftar.push({
                    name: namaBahan,
                    price: hargaBahan[namaBahan] || 0,
                    checked: false,
                    source: namaResep
                });

                jumlahDitambahkan++;

            }

        });

        // Menyimpan daftar belanja
        localStorage.setItem(STORAGE_KEY, JSON.stringify(daftar));

        // Notifikasi
        if (jumlahDitambahkan > 0) {

            alert(
                jumlahDitambahkan +
                ' bahan berhasil ditambahkan ke Daftar Belanja!'
            );

        } else {

            alert(
                'Bahan yang belum kamu miliki sudah ada di Daftar Belanja.'
            );

        }

    });

});
</script>

@endsection
