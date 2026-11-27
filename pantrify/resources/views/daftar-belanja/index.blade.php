
@extends('layouts.app')

@section('title', 'Daftar Belanja - Pantrify')

@section('content')

<style>
    .shopping-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
    }

    .shopping-item {
        padding: 15px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .shopping-item:last-child {
        border-bottom: none;
    }

    .shopping-item input:checked + label {
        text-decoration: line-through;
        color: #94a3b8;
    }

    .shopping-total {
        background: #f0f7f0;
        border-radius: 15px;
    }

    .empty-state {
        padding: 45px 15px;
        text-align: center;
    }

    .empty-state i {
        font-size: 55px;
        color: #9caf9e;
    }

    .price-text {
        font-weight: 600;
        color: #477b55;
    }
</style>

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="mb-4">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-2">
            <i class="bi bi-basket me-1"></i> Pantrify
        </span>

        <h1 class="h4 fw-bold text-dark mb-1">
            Daftar Belanja
        </h1>

        <p class="text-muted small mb-0">
            Kelola bahan makanan yang perlu kamu beli dan pantau estimasi biayanya.
        </p>
    </div>

    <div class="row g-4">

        {{-- Daftar Bahan --}}
        <div class="col-12 col-lg-8">

            <div class="card shopping-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="h6 fw-bold mb-1">Daftar Bahan</h2>
                            <p class="text-muted small mb-0">
                                <span id="jumlah-bahan">0</span> bahan dalam daftar
                            </p>
                        </div>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger rounded-pill"
                            id="hapus-semua"
                        >
                            <i class="bi bi-trash me-1"></i>
                            Hapus Semua
                        </button>
                    </div>

                    {{-- Daftar bahan akan ditampilkan melalui JavaScript --}}
                    <div id="daftar-item">

                        <div class="empty-state">
                            <i class="bi bi-basket"></i>
                            <h3 class="h6 fw-bold mt-3">Daftar Belanja Masih Kosong</h3>
                            <p class="text-muted small">
                                Tambahkan bahan dari halaman Detail Resep untuk mulai membuat daftar belanja.
                            </p>
                            <a href="{{ url('/meal-planner') }}"
                               class="btn btn-success rounded-pill px-4">
                                Lihat Meal Planner
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- Ringkasan Belanja --}}
        <div class="col-12 col-lg-4">

            <div class="card shopping-card">

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Ringkasan Belanja
                    </h2>

                    <div class="d-flex justify-content-between mb-3 small">
                        <span class="text-muted">Total bahan</span>
                        <strong id="ringkasan-jumlah">0 bahan</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3 small">
                        <span class="text-muted">Bahan sudah dibeli</span>
                        <strong id="ringkasan-selesai">0 bahan</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3 small">
                        <span class="text-muted">Belum dibeli</span>
                        <strong id="ringkasan-belum">0 bahan</strong>
                    </div>

                    <hr>

                    <div class="shopping-total p-3">

                        <p class="text-muted small mb-1">
                            Total Estimasi Harga
                        </p>

                        <h3 class="h4 fw-bold text-success mb-0"
                            id="total-harga">
                            Rp0
                        </h3>

                    </div>

                    <p class="text-muted mt-3 mb-0" style="font-size: 12px;">
                        *Harga merupakan perkiraan dan dapat berubah sesuai tempat pembelian.
                    </p>

                </div>

            </div>

            <div class="card shopping-card mt-4">

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-2">
                        Tips Belanja
                    </h2>

                    <p class="text-muted small mb-0">
                        Centang bahan yang sudah dibeli agar kamu lebih mudah mengetahui bahan yang masih perlu dibeli.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const STORAGE_KEY = 'pantrify_daftar_belanja';

    const container = document.getElementById('daftar-item');

    const formatRupiah = (angka) => {
        return 'Rp' + Number(angka).toLocaleString('id-ID');
    };

    function ambilData() {
        try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
        } catch (error) {
            return [];
        }
    }

    function simpanData(data) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    }

    function tampilkanDaftar() {

        const data = ambilData();

        const total = data.length;
        const selesai = data.filter(item => item.checked).length;
        const belum = total - selesai;

        const totalHarga = data.reduce((sum, item) => {
            return sum + Number(item.price || 0);
        }, 0);

        document.getElementById('jumlah-bahan').textContent = total;
        document.getElementById('ringkasan-jumlah').textContent = total + ' bahan';
        document.getElementById('ringkasan-selesai').textContent = selesai + ' bahan';
        document.getElementById('ringkasan-belum').textContent = belum + ' bahan';
        document.getElementById('total-harga').textContent = formatRupiah(totalHarga);

        if (total === 0) {

            container.innerHTML = `
                <div class="empty-state">
                    <i class="bi bi-basket"></i>
                    <h3 class="h6 fw-bold mt-3">Daftar Belanja Masih Kosong</h3>
                    <p class="text-muted small">
                        Tambahkan bahan dari halaman Detail Resep untuk mulai membuat daftar belanja.
                    </p>
                    <a href="{{ url('/meal-planner') }}"
                       class="btn btn-success rounded-pill px-4">
                        Lihat Meal Planner
                    </a>
                </div>
            `;

            return;
        }

        container.innerHTML = data.map((item, index) => `
            <div class="shopping-item d-flex justify-content-between align-items-center gap-3">

                <div class="form-check flex-grow-1">

                    <input
                        class="form-check-input item-check"
                        type="checkbox"
                        id="item-${index}"
                        data-index="${index}"
                        ${item.checked ? 'checked' : ''}
                    >

                    <label
                        class="form-check-label fw-semibold"
                        for="item-${index}"
                    >
                        ${escapeHTML(item.name)}
                    </label>

                    <div class="text-muted small mt-1">
                        ${escapeHTML(item.source || 'Tambahan bahan')}
                    </div>

                </div>

                <div class="text-end d-flex align-items-center gap-2">

                    <span class="price-text small">
                        ${formatRupiah(item.price)}
                    </span>

                    <button
                        type="button"
                        class="btn btn-sm text-danger hapus-item"
                        data-index="${index}"
                        aria-label="Hapus bahan"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>

            </div>
        `).join('');
    }

    function escapeHTML(value) {
        return String(value).replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    // Checklist bahan
    container.addEventListener('change', function (event) {

        if (!event.target.classList.contains('item-check')) return;

        const data = ambilData();
        const index = Number(event.target.dataset.index);

        if (!data[index]) return;

        data[index].checked = event.target.checked;

        simpanData(data);
        tampilkanDaftar();
    });

    // Hapus satu bahan
    container.addEventListener('click', function (event) {

        const tombol = event.target.closest('.hapus-item');

        if (!tombol) return;

        const data = ambilData();
        const index = Number(tombol.dataset.index);

        data.splice(index, 1);

        simpanData(data);
        tampilkanDaftar();
    });

    // Hapus semua bahan
    document.getElementById('hapus-semua').addEventListener('click', function () {

        if (!confirm('Apakah kamu yakin ingin menghapus semua daftar belanja?')) {
            return;
        }

        localStorage.removeItem(STORAGE_KEY);
        tampilkanDaftar();
    });

    tampilkanDaftar();

});
</script>

@endsection
