@extends('layouts.app')

@section('title', 'Meal Planner - Pantrify')

@section('content')
@php
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');

    // Data dummy fallback jika controller belum mengirim data $rencanaMenu
    $rencanaMenu = $rencanaMenu ?? [
        [
            'hari' => 'Senin',
            'tanggal' => 'Hari 1',
            'total_biaya' => 42000,
            'total_kalori' => 1850,
            'total_protein' => 95,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Oatmeal Pisang & Telur Rebus', 'kalori' => 420, 'protein' => 22, 'biaya' => 10000],
                ['waktu' => 'Makan Siang', 'nama' => 'Ayam Tumis Sayuran & Nasi Merah', 'kalori' => 750, 'protein' => 45, 'biaya' => 17000],
                ['waktu' => 'Makan Malam', 'nama' => 'Sup Tahu Sutra & Brokoli', 'kalori' => 680, 'protein' => 28, 'biaya' => 15000],
            ]
        ],
        [
            'hari' => 'Selasa',
            'tanggal' => 'Hari 2',
            'total_biaya' => 45000,
            'total_kalori' => 1920,
            'total_protein' => 102,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Roti Gandum Panggang & Orak-arik Telur', 'kalori' => 450, 'protein' => 24, 'biaya' => 11000],
                ['waktu' => 'Makan Siang', 'nama' => 'Ikan Kembung Bakar & Urap Sayur', 'kalori' => 790, 'protein' => 48, 'biaya' => 19000],
                ['waktu' => 'Makan Malam', 'nama' => 'Tempe Orek Basah & Tumis Kangkung', 'kalori' => 680, 'protein' => 30, 'biaya' => 15000],
            ]
        ],
        [
            'hari' => 'Rabu',
            'tanggal' => 'Hari 3',
            'total_biaya' => 40000,
            'total_kalori' => 1800,
            'total_protein' => 90,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Bubur Ayam Kampung Rumahan', 'kalori' => 480, 'protein' => 25, 'biaya' => 12000],
                ['waktu' => 'Makan Siang', 'nama' => 'Pepes Tahu Jamur & Sayur Asem', 'kalori' => 640, 'protein' => 30, 'biaya' => 13000],
                ['waktu' => 'Makan Malam', 'nama' => 'Dada Ayam Teriyaki & Buncis', 'kalori' => 680, 'protein' => 35, 'biaya' => 15000],
            ]
        ],
        [
            'hari' => 'Kamis',
            'tanggal' => 'Hari 4',
            'total_biaya' => 46000,
            'total_kalori' => 1950,
            'total_protein' => 105,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Smoothie Bayam Pisang & Kacang', 'kalori' => 400, 'protein' => 18, 'biaya' => 12000],
                ['waktu' => 'Makan Siang', 'nama' => 'Soto Ayam Bening & Telur Rebus', 'kalori' => 800, 'protein' => 47, 'biaya' => 18000],
                ['waktu' => 'Makan Malam', 'nama' => 'Telur Dadar Padang & Daun Singkong', 'kalori' => 750, 'protein' => 40, 'biaya' => 16000],
            ]
        ],
        [
            'hari' => 'Jumat',
            'tanggal' => 'Hari 5',
            'total_biaya' => 43000,
            'total_kalori' => 1880,
            'total_protein' => 98,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Nasi Goreng Kampung & Telur Mata Sapi', 'kalori' => 520, 'protein' => 22, 'biaya' => 11000],
                ['waktu' => 'Makan Siang', 'nama' => 'Tongkol Suwir Pedas & Tumis Labu', 'kalori' => 720, 'protein' => 46, 'biaya' => 17000],
                ['waktu' => 'Makan Malam', 'nama' => 'Capcay Kuah Ayam & Tahu', 'kalori' => 640, 'protein' => 30, 'biaya' => 15000],
            ]
        ],
        [
            'hari' => 'Sabtu',
            'tanggal' => 'Hari 6',
            'total_biaya' => 48000,
            'total_kalori' => 2000,
            'total_protein' => 110,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Pancake Pisang Oat & Madu', 'kalori' => 460, 'protein' => 20, 'biaya' => 12000],
                ['waktu' => 'Makan Siang', 'nama' => 'Ayam Panggang Madu & Salad Sayur', 'kalori' => 840, 'protein' => 52, 'biaya' => 20000],
                ['waktu' => 'Makan Malam', 'nama' => 'Sup Krim Jagung & Ayam Suwir', 'kalori' => 700, 'protein' => 38, 'biaya' => 16000],
            ]
        ],
        [
            'hari' => 'Minggu',
            'tanggal' => 'Hari 7',
            'total_biaya' => 44000,
            'total_kalori' => 1900,
            'total_protein' => 96,
            'menu' => [
                ['waktu' => 'Sarapan', 'nama' => 'Lontong Sayur Labu & Telur Balado', 'kalori' => 500, 'protein' => 22, 'biaya' => 12000],
                ['waktu' => 'Makan Siang', 'nama' => 'Gado-Gado Komplit & Tahu Tempe', 'kalori' => 760, 'protein' => 36, 'biaya' => 16000],
                ['waktu' => 'Makan Malam', 'nama' => 'Tumis Daging Sapi Lada Hitam & Pakcoy', 'kalori' => 640, 'protein' => 38, 'biaya' => 16000],
            ]
        ],
    ];

    $totalEstimasiMingguan = collect($rencanaMenu)->sum('total_biaya');
    $anggaranInput = old('anggaran_mingguan', $anggaranMingguan ?? 350000);
@endphp

<style>
    .pantry-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
    }
    .form-control-clean, .form-select-clean {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.6rem 0.85rem;
        font-size: 0.9rem;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control-clean:focus, .form-select-clean:focus {
        background-color: #ffffff;
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }
    /* Custom Checkbox Chips untuk Preferensi Makanan */
    .pref-chip-input {
        display: none;
    }
    .pref-chip-label {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.85rem;
        border-radius: 999px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
    }
    .pref-chip-label:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }
    .pref-chip-input:checked + .pref-chip-label {
        background: #0f172a;
        color: #ffffff;
        border-color: #0f172a;
    }
    /* Tab Hari */
    .day-pills .nav-link {
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        padding: 0.65rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-align: center;
    }
    .day-pills .nav-link:hover {
        border-color: #cbd5e1;
        color: #0f172a;
    }
    .day-pills .nav-link.active {
        background: #0f172a;
        color: #ffffff;
        border-color: #0f172a;
    }
    .meal-item-card {
        border: 1px solid #f1f5f9;
        background: #fcfaf8;
        border-radius: 1rem;
        transition: all 0.2s ease;
    }
    .meal-item-card:hover {
        background: #ffffff;
        border-color: #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
</style>

<div class="container-fluid px-0">
    
    {{-- Header Halaman --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Meal Planner 7 Hari</h1>
            <p class="text-muted small mb-0">Atur anggaran, target gizi, dan biarkan AI menyusun menu harianmu</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill small fw-medium shadow-sm">
                Total Estimasi 7 Hari: <strong class="text-success">{{ $rp($totalEstimasiMingguan) }}</strong>
            </span>
        </div>
    </div>

    <div class="row g-4">
        
        {{-- KOLOM KIRI: Input Anggaran, Gizi & Preferensi --}}
        <div class="col-12 col-xl-4">
            <div class="card pantry-card sticky-xl-top" style="top: 1.5rem; z-index: 10;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-dark text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                            <i class="bi bi-sliders"></i>
                        </div>
                        <h2 class="h6 fw-bold text-dark mb-0">Atur Target & Preferensi</h2>
                    </div>

                    <form action="{{ route('meal-planner') }}" method="GET">
                        {{-- 1. Input Anggaran Mingguan --}}
                        <div class="mb-3">
                            <label for="anggaran_mingguan" class="form-label small fw-semibold text-dark">Anggaran Mingguan (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted small" style="border-radius: 0.75rem 0 0 0.75rem;">Rp</span>
                                <input type="number" id="anggaran_mingguan" name="anggaran_mingguan"
                                       class="form-control form-control-clean border-start-0"
                                       style="border-radius: 0 0.75rem 0.75rem 0;"
                                       value="{{ $anggaranInput }}" min="50000" step="10000" required>
                            </div>
                            <div class="form-text" style="font-size: 0.75rem;">
                                Rata-rata harian: <strong>{{ $rp($anggaranInput / 7) }}</strong> / hari
                            </div>
                        </div>

                        {{-- 2. Input Kebutuhan Gizi --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark d-block">Target Gizi Harian</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="target_kalori" class="text-muted mb-1" style="font-size: 0.75rem;">Kalori (kkal)</label>
                                    <input type="number" id="target_kalori" name="target_kalori"
                                           class="form-control form-control-clean"
                                           value="{{ old('target_kalori', $targetKalori ?? 1900) }}" min="1000" max="4500">
                                </div>
                                <div class="col-6">
                                    <label for="target_protein" class="text-muted mb-1" style="font-size: 0.75rem;">Protein (gram)</label>
                                    <input type="number" id="target_protein" name="target_protein"
                                           class="form-control form-control-clean"
                                           value="{{ old('target_protein', $targetProtein ?? 95) }}" min="30" max="300">
                                </div>
                                <div class="col-6">
                                    <label for="target_karbo" class="text-muted mb-1" style="font-size: 0.75rem;">Karbohidrat (g)</label>
                                    <input type="number" id="target_karbo" name="target_karbo"
                                           class="form-control form-control-clean"
                                           value="{{ old('target_karbo', $targetKarbo ?? 220) }}" min="20" max="500">
                                </div>
                                <div class="col-6">
                                    <label for="target_lemak" class="text-muted mb-1" style="font-size: 0.75rem;">Lemak (g)</label>
                                    <input type="number" id="target_lemak" name="target_lemak"
                                           class="form-control form-control-clean"
                                           value="{{ old('target_lemak', $targetLemak ?? 55) }}" min="15" max="200">
                                </div>
                            </div>
                        </div>

                        {{-- 3. Preferensi Makanan --}}
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-dark d-block mb-2">Preferensi & Pantangan</label>
                            @php
                                $daftarPreferensi = [
                                    'Halal', 'Tinggi Protein', 'Hemat / Ekonomis', 
                                    'Masakan Nusantara', 'Praktis < 30 Menit', 
                                    'Rendah Gula', 'Vegetarian', 'Tanpa Seafood'
                                ];
                                $preferensiTerpilih = request('preferensi', ['Halal', 'Masakan Nusantara']);
                            @endphp
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($daftarPreferensi as $idx => $pref)
                                    <div>
                                        <input type="checkbox" class="pref-chip-input" name="preferensi[]"
                                               id="pref_{{ $idx }}" value="{{ $pref }}"
                                               {{ in_array($pref, (array)$preferensiTerpilih) ? 'checked' : '' }}>
                                        <label class="pref-chip-label" for="pref_{{ $idx }}">
                                            {{ $pref }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 rounded-pill py-2.5 fw-semibold small shadow-sm">
                            <i class="bi bi-stars text-warning me-1"></i> Buat Rekomendasi Menu AI
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Rekomendasi Menu 7 Hari & Estimasi Biaya --}}
        <div class="col-12 col-xl-8">
            
            {{-- Ringkasan Perbandingan Anggaran vs Estimasi AI --}}
            @php
                $selisihAnggaran = $anggaranInput - $totalEstimasiMingguan;
            @endphp
            <div class="card pantry-card mb-4 border-0" style="background: #0f172a; color: #ffffff;">
                <div class="card-body p-4">
                    <div class="row align-items-center g-3">
                        <div class="col-md-7">
                            <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-1 small fw-semibold mb-2">
                                <i class="bi bi-robot me-1"></i> Analisis AI Pantrify
                            </span>
                            <h3 class="h5 fw-bold text-white mb-1">Rencana Menu 7 Hari Siap!</h3>
                            <p class="text-white-50 small mb-0">
                                Disusun sesuai target <strong>{{ request('target_kalori', 1900) }} kkal</strong> &amp; <strong>{{ request('target_protein', 95) }}g protein</strong> per hari.
                            </p>
                        </div>
                        <div class="col-md-5 text-md-end">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10">
                                <span class="text-white-50 small d-block">Estimasi Total Belanja</span>
                                <span class="fs-4 fw-bold text-white">{{ $rp($totalEstimasiMingguan) }}</span>
                                <div class="small mt-1 {{ $selisihAnggaran >= 0 ? 'text-success' : 'text-warning' }}">
                                    @if($selisihAnggaran >= 0)
                                        <i class="bi bi-check-circle-fill me-1"></i> Hemat {{ $rp($selisihAnggaran) }} dari anggaran
                                    @else
                                        <i class="bi bi-exclamation-circle-fill me-1"></i> Lebih {{ $rp(abs($selisihAnggaran)) }} dari anggaran
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigasi Tab 7 Hari (Senin - Minggu) --}}
            <ul class="nav nav-pills day-pills gap-2 mb-4 flex-nowrap overflow-auto pb-1" id="pills-tab" role="tablist">
                @foreach($rencanaMenu as $index => $hariData)
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 {{ $index === 0 ? 'active' : '' }}"
                                id="tab-hari-{{ $index }}"
                                data-bs-toggle="pill"
                                data-bs-target="#konten-hari-{{ $index }}"
                                type="button" role="tab">
                            <div class="fw-bold">{{ $hariData['hari'] }}</div>
                            <div style="font-size: 0.7rem; opacity: 0.8;">{{ $rp($hariData['total_biaya']) }}</div>
                        </button>
                    </li>
                @endforeach
            </ul>

            {{-- Isi Detail Menu Per Hari --}}
            <div class="tab-content" id="pills-tabContent">
                @foreach($rencanaMenu as $index => $hariData)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                         id="konten-hari-{{ $index }}" role="tabpanel">
                        
                        <div class="card pantry-card">
                            <div class="card-body p-4">
                                {{-- Header Hari --}}
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pb-3 mb-3 border-bottom">
                                    <div>
                                        <h3 class="h5 fw-bold text-dark mb-1">Menu Hari {{ $hariData['hari'] }}</h3>
                                        <div class="d-flex flex-wrap gap-3 small text-muted">
                                            <span><i class="bi bi-fire text-danger me-1"></i>Total <strong>{{ $hariData['total_kalori'] }}</strong> kkal</span>
                                            <span><i class="bi bi-egg-fried text-warning me-1"></i>Protein <strong>{{ $hariData['total_protein'] }}g</strong></span>
                                            <span><i class="bi bi-tag-fill text-success me-1"></i>Estimasi <strong>{{ $rp($hariData['total_biaya']) }}</strong></span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold">
                                        <i class="bi bi-arrow-repeat me-1"></i> Acak Ulang Hari Ini
                                    </button>
                                </div>

                                {{-- Daftar Sarapan, Makan Siang, Makan Malam --}}
                                <div class="d-flex flex-column gap-3">
                                    @foreach($hariData['menu'] as $makan)
                                        <div class="meal-item-card p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-1">
                                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 fw-semibold" style="font-size: 0.72rem;">
                                                        {{ $makan['waktu'] }}
                                                    </span>
                                                    <span class="text-muted small">
                                                        &bull; {{ $makan['kalori'] }} kkal &bull; {{ $makan['protein'] }}g protein
                                                    </span>
                                                </div>
                                                <h4 class="h6 fw-bold text-dark mb-0">{{ $makan['nama'] }}</h4>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-3 border-top border-md-0 pt-2 pt-md-0">
                                                <div class="text-md-end">
                                                    <span class="text-muted d-block" style="font-size: 0.7rem;">Estimasi Biaya</span>
                                                    <strong class="text-dark small">{{ $rp($makan['biaya']) }}</strong>
                                                </div>
                                                <button type="button" class="btn btn-white bg-white border rounded-pill px-3 py-1.5 small fw-semibold shadow-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalResep"
                                                        data-nama="{{ $makan['nama'] }}"
                                                        data-biaya="{{ $rp($makan['biaya']) }}"
                                                        data-kalori="{{ $makan['kalori'] }} kkal"
                                                        data-protein="{{ $makan['protein'] }}g">
                                                    Resep
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

{{-- Modal Detail Resep Singkat --}}
<div class="modal fade" id="modalResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="modalResepJudul">Detail Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-2 mb-3">
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1" id="modalResepBiaya"></span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-1" id="modalResepKalori"></span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-1" id="modalResepProtein"></span>
                </div>
                <p class="small text-muted mb-2 fw-semibold">Bahan & Langkah Singkat:</p>
                <p class="small text-secondary mb-0">
                    Siapkan bahan utama sesuai porsi, tumis bumbu dasar hingga harum, masak hingga matang merata, dan sajikan selagi hangat. Bahan yang tersedia di <strong>Stok Dapur</strong> akan otomatis diprioritaskan.
                </p>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-dark rounded-pill px-4 small fw-semibold" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalResep = document.getElementById('modalResep');
        if (modalResep) {
            modalResep.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                document.getElementById('modalResepJudul').textContent = button.getAttribute('data-nama');
                document.getElementById('modalResepBiaya').textContent = 'Estimasi: ' + button.getAttribute('data-biaya');
                document.getElementById('modalResepKalori').textContent = button.getAttribute('data-kalori');
                document.getElementById('modalResepProtein').textContent = 'Protein: ' + button.getAttribute('data-protein');
            });
        }
    });
</script>
@endsection