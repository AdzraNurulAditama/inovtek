@extends('layouts.app')

@section('title', 'Kelola Stok')

@section('content')
@php
    $urlResep = \Illuminate\Support\Facades\Route::has('meal-planner') ? route('meal-planner') : '#';
    $urlBelanja = \Illuminate\Support\Facades\Route::has('daftar-belanja.index') ? route('daftar-belanja.index') : (\Illuminate\Support\Facades\Route::has('daftar-belanja') ? route('daftar-belanja') : '#');
@endphp
<style>
    .ks-title { font-weight: 700; color: #0f172a; margin: 0; font-size: 1.6rem; }
    .ks-sub { color: #64748b; font-size: .9rem; margin: .15rem 0 0; }
    .ks-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 1.25rem; box-shadow: 0 4px 20px -2px rgba(0,0,0,.04); }
    .ks-stat { padding: 1.1rem 1.25rem; display: flex; align-items: center; gap: 1rem; height: 100%; }
    .ks-stat-icon { width: 44px; height: 44px; border-radius: .85rem; display: grid; place-items: center; font-size: 1.2rem; flex-shrink: 0; }
    .ks-stat-label { color: #64748b; font-size: .8rem; }
    .ks-stat-value { font-size: 1.5rem; font-weight: 700; color: #0f172a; line-height: 1.2; }
    .ic-green { background: #dcfce7; color: #15803d; }
    .ic-yellow { background: #fef9c3; color: #a16207; }
    .ic-red { background: #fee2e2; color: #b91c1c; }

    .ks-banner { background: #0f172a; color: #fff; border-radius: 1.25rem; padding: 1.4rem 1.6rem; margin-bottom: 1.5rem; }
    .ks-banner h2 { font-size: 1.2rem; font-weight: 700; margin: 0; }
    .ks-banner p { color: #94a3b8; font-size: .86rem; margin: .2rem 0 .9rem; }
    .ks-pill { background: #1e293b; border-radius: 999px; padding: .3rem .8rem; font-size: .82rem; display: inline-flex; gap: .45rem; align-items: center; }
    .ks-pill b { font-weight: 600; }
    .ks-pill.red i { color: #f87171; } .ks-pill.yellow i { color: #facc15; }
    .ks-btn-green { background: #16a34a; color: #fff; border: 0; border-radius: 999px; padding: .6rem 1.2rem; font-weight: 600; font-size: .9rem; text-decoration: none; display: inline-block; white-space: nowrap; }
    .ks-btn-green:hover { background: #15803d; color: #fff; }
    .ks-need { background: #fffbeb; border: 1px solid #fde68a; border-radius: 1.25rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; font-size: .9rem; color: #713f12; }
    .ks-need a { color: #0f172a; font-weight: 600; }

    .ks-btn-dark { background: #0f172a; color: #fff; border: 0; border-radius: 999px; padding: .6rem 1.2rem; font-weight: 600; font-size: .9rem; }
    .ks-btn-dark:hover { background: #1e293b; color: #fff; }
    .ks-btn-light { background: #fff; border: 1px solid #e2e8f0; color: #0f172a; border-radius: 999px; padding: .6rem 1.2rem; font-weight: 600; font-size: .9rem; }
    .ks-btn-red { background: #dc2626; color: #fff; border: 0; border-radius: 999px; padding: .6rem 1.2rem; font-weight: 600; font-size: .9rem; }
    .ks-btn-red:hover { background: #b91c1c; color: #fff; }
    .ks-search { position: relative; }
    .ks-search i { position: absolute; left: .9rem; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .ks-search input { padding-left: 2.4rem; border-radius: 999px; border: 1px solid #e2e8f0; background: #f8fafc; height: 42px; }
    .ks-search input:focus, .ks-form .form-control:focus, .ks-form .form-select:focus { border-color: #0f172a; box-shadow: 0 0 0 .2rem rgba(15,23,42,.08); }
    .ks-filter-label { font-size: .78rem; color: #64748b; font-weight: 600; width: 70px; flex-shrink: 0; padding-top: .4rem; }
    .ks-chip { border: 1px solid #e2e8f0; background: #fff; color: #475569; border-radius: 999px; padding: .35rem .9rem; font-size: .82rem; cursor: pointer; }
    .ks-chip:hover { background: #f1f5f9; }
    .ks-chip.active { background: #0f172a; color: #fff; border-color: #0f172a; }

    .ks-table { margin: 0; }
    .ks-table th { color: #64748b; font-weight: 600; font-size: .8rem; border-bottom: 1px solid #e2e8f0; padding: .85rem 1.1rem; white-space: nowrap; background: transparent; }
    .ks-table td { padding: .85rem 1.1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: .9rem; background: transparent; }
    .ks-table tr:last-child td { border-bottom: 0; }
    .ks-name { font-weight: 600; }
    .ks-cat { background: #f1f5f9; color: #475569; border-radius: 999px; padding: .2rem .7rem; font-size: .78rem; white-space: nowrap; }
    .ks-loc { color: #475569; white-space: nowrap; }
    .ks-loc i { color: #94a3b8; margin-right: .3rem; }
    .ks-badge { border-radius: 999px; padding: .22rem .7rem; font-size: .76rem; font-weight: 600; white-space: nowrap; display: inline-flex; align-items: center; gap: .35rem; }
    .ks-badge::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
    .ks-mini { font-size: .72rem; font-weight: 600; border-radius: 999px; padding: .1rem .5rem; margin-left: .4rem; }
    .b-green { background: #dcfce7; color: #15803d; }
    .b-yellow { background: #fef9c3; color: #a16207; }
    .b-red { background: #fee2e2; color: #b91c1c; }
    .ks-act { width: 34px; height: 34px; border-radius: .6rem; border: 1px solid #e2e8f0; background: #fff; color: #475569; display: inline-grid; place-items: center; }
    .ks-act:hover { background: #f1f5f9; color: #0f172a; }
    .ks-act.use:hover { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }
    .ks-act.danger:hover { background: #fee2e2; color: #b91c1c; border-color: #fecaca; }
    .ks-act:disabled { opacity: .4; pointer-events: none; }
    .ks-empty { text-align: center; padding: 3rem 1rem; color: #64748b; }
    .ks-empty i { font-size: 2.2rem; color: #cbd5e1; display: block; margin-bottom: .5rem; }

    .ks-modal .modal-content { border: 0; border-radius: 1.25rem; }
    .ks-modal .modal-header { border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; }
    .ks-modal .modal-body { padding: 1.25rem 1.5rem; }
    .ks-modal .modal-footer { border-top: 1px solid #f1f5f9; padding: 1rem 1.5rem; }
    .ks-form label { font-size: .85rem; font-weight: 600; color: #0f172a; margin-bottom: .3rem; }
    .ks-form .form-control, .ks-form .form-select { border-radius: .75rem; border-color: #e2e8f0; background: #f8fafc; padding: .6rem .85rem; }
    .ks-hint { font-size: .78rem; color: #15803d; margin-top: .3rem; }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
    <div>
        <h1 class="ks-title">Kelola Stok</h1>
        <p class="ks-sub">Pantau bahan di dapurmu, jumlahnya, dan kapan kadaluwarsa.</p>
    </div>
    <button class="ks-btn-dark" id="btnTambah"><i class="bi bi-plus-lg me-1"></i> Tambah Bahan</button>
</div>

<div class="ks-banner d-none" id="banner" data-resep="{{ $urlResep }}">
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
        <div>
            <h2><i class="bi bi-alarm me-2"></i>Segera habiskan</h2>
            <p>Bahan ini sudah dekat atau lewat tanggal kadaluwarsa. Masak lebih dulu supaya tidak terbuang.</p>
            <div class="d-flex flex-wrap gap-2" id="bannerList"></div>
        </div>
        <a href="#" class="ks-btn-green" id="bannerBtn"><i class="bi bi-journal-richtext me-1"></i> Lihat resep dengan bahan ini</a>
    </div>
</div>

<div class="ks-need d-none" id="needBox" data-url="{{ $urlBelanja }}">
    <i class="bi bi-cart-plus me-1"></i> Stok habis dan masuk daftar belanja: <b id="needList"></b>.
    <a href="{{ $urlBelanja }}">Buka Daftar Belanja</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3"><div class="ks-card ks-stat"><div class="ks-stat-icon ic-green"><i class="bi bi-box-seam"></i></div><div><div class="ks-stat-label">Total Bahan</div><div class="ks-stat-value" id="statTotal">0</div></div></div></div>
    <div class="col-6 col-lg-3"><div class="ks-card ks-stat"><div class="ks-stat-icon ic-yellow"><i class="bi bi-hourglass-split"></i></div><div><div class="ks-stat-label">Segera kadaluwarsa</div><div class="ks-stat-value" id="statSoon">0</div></div></div></div>
    <div class="col-6 col-lg-3"><div class="ks-card ks-stat"><div class="ks-stat-icon ic-red"><i class="bi bi-exclamation-triangle"></i></div><div><div class="ks-stat-label">Sudah kadaluwarsa</div><div class="ks-stat-value" id="statExpired">0</div></div></div></div>
    <div class="col-6 col-lg-3"><div class="ks-card ks-stat"><div class="ks-stat-icon ic-yellow"><i class="bi bi-graph-down-arrow"></i></div><div><div class="ks-stat-label">Stok menipis / habis</div><div class="ks-stat-value" id="statLow">0</div></div></div></div>
</div>

<div class="ks-card">
    <div class="p-3 p-md-4 pb-3">
        <div class="ks-search mb-3">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama bahan...">
        </div>
        <div class="d-flex gap-2 mb-2"><span class="ks-filter-label">Kategori</span><div class="d-flex flex-wrap gap-2" id="chipKat"></div></div>
        <div class="d-flex gap-2"><span class="ks-filter-label">Lokasi</span><div class="d-flex flex-wrap gap-2" id="chipLok"></div></div>
    </div>
    <div class="table-responsive">
        <table class="table ks-table">
            <thead>
                <tr><th>Nama Bahan</th><th>Kategori</th><th>Lokasi</th><th>Stok</th><th>Kadaluwarsa</th><th>Status</th><th class="text-end">Aksi</th></tr>
            </thead>
            <tbody id="stokBody"></tbody>
        </table>
    </div>
    <div class="ks-empty d-none" id="emptyState">
        <i class="bi bi-inbox"></i>
        <div class="fw-semibold">Tidak ada bahan ditemukan</div>
        <div style="font-size:.85rem">Ubah kata kunci atau filter, atau tambahkan bahan baru.</div>
    </div>
</div>

<!-- Modal tambah / edit -->
<div class="modal fade ks-modal" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content ks-form" id="formBahan" novalidate>
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Tambah Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fId">
                <div class="mb-3"><label for="fNama">Nama bahan</label><input type="text" class="form-control" id="fNama" placeholder="Contoh: Bayam" required></div>
                <div class="row g-3 mb-3">
                    <div class="col-6"><label for="fKategori">Kategori</label><select class="form-select" id="fKategori"></select></div>
                    <div class="col-6"><label for="fLokasi">Lokasi simpan</label><select class="form-select" id="fLokasi"></select></div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-4"><label for="fJumlah">Jumlah</label><input type="number" class="form-control" id="fJumlah" min="0" step="any" required></div>
                    <div class="col-4"><label for="fSatuan">Satuan</label><select class="form-select" id="fSatuan"></select></div>
                    <div class="col-4"><label for="fMin">Batas minimum</label><input type="number" class="form-control" id="fMin" min="0" step="any" value="0"></div>
                </div>
                <div>
                    <label for="fTanggal">Tanggal kadaluwarsa</label>
                    <input type="date" class="form-control" id="fTanggal" required>
                    <div class="ks-hint d-none" id="fHint"></div>
                </div>
                <div class="text-danger mt-3 d-none" id="formError" style="font-size:.85rem">Lengkapi nama, jumlah, dan tanggal kadaluwarsa.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="ks-btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="ks-btn-dark">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal hapus -->
<div class="modal fade ks-modal" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center pt-4">
                <div class="ks-stat-icon ic-red mx-auto mb-3"><i class="bi bi-trash3"></i></div>
                <h6 class="fw-bold mb-1">Hapus bahan ini?</h6>
                <p class="text-muted mb-0" style="font-size:.88rem"><span id="hapusNama" class="fw-semibold"></span> akan dihapus dari stok.</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0 pb-4">
                <button type="button" class="ks-btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="ks-btn-red" id="btnKonfirmasiHapus">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast align-items-center text-bg-dark border-0" role="status" aria-live="polite">
        <div class="d-flex"><div class="toast-body" id="toastBody"></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button></div>
    </div>
</div>

@verbatim
<script>
document.addEventListener('DOMContentLoaded', function () {
    var KATEGORI = ['Sayuran', 'Buah', 'Daging & Ikan', 'Telur & Susu', 'Bumbu', 'Bahan Pokok', 'Lainnya'];
    var LOKASI = ['Kulkas', 'Freezer', 'Rak Kering'];
    var LOK_ICON = { 'Kulkas': 'bi-snow2', 'Freezer': 'bi-thermometer-snow', 'Rak Kering': 'bi-grid-3x3-gap' };
    var SATUAN = ['kg', 'gram', 'butir', 'liter', 'pcs'];
    var STEP = { kg: 0.25, gram: 50, butir: 1, liter: 0.25, pcs: 1 };

    // Perkiraan umur simpan (hari) di kulkas / suhu ruang. Freezer dikali 8.
    var UMUR_NAMA = { bayam: 3, kangkung: 3, sawi: 4, brokoli: 5, wortel: 14, tomat: 7, cabai: 7, telur: 21, susu: 7, yogurt: 14, keju: 30, ayam: 2, daging: 3, ikan: 2, udang: 2, tahu: 3, tempe: 3, pisang: 5, apel: 21, jeruk: 14, beras: 180, mie: 180, tepung: 180, gula: 365, bawang: 30 };
    var UMUR_KAT = { 'Sayuran': 5, 'Buah': 7, 'Daging & Ikan': 2, 'Telur & Susu': 7, 'Bumbu': 30, 'Bahan Pokok': 180, 'Lainnya': 14 };

    function isoOffset(d) { var x = new Date(); x.setDate(x.getDate() + d); return x.toISOString().slice(0, 10); }

    // Data contoh. Nanti ganti dengan data dari database.
    var data = [
        { id: 1, nama: 'Telur ayam', kategori: 'Telur & Susu', lokasi: 'Kulkas', jumlah: 2, satuan: 'butir', min: 4, tanggal: isoOffset(6) },
        { id: 2, nama: 'Bayam', kategori: 'Sayuran', lokasi: 'Kulkas', jumlah: 1, satuan: 'kg', min: 0.25, tanggal: isoOffset(1) },
        { id: 3, nama: 'Beras', kategori: 'Bahan Pokok', lokasi: 'Rak Kering', jumlah: 1.5, satuan: 'kg', min: 2, tanggal: isoOffset(120) },
        { id: 4, nama: 'Dada ayam', kategori: 'Daging & Ikan', lokasi: 'Freezer', jumlah: 500, satuan: 'gram', min: 250, tanggal: isoOffset(2) },
        { id: 5, nama: 'Susu UHT', kategori: 'Telur & Susu', lokasi: 'Kulkas', jumlah: 1, satuan: 'liter', min: 0.5, tanggal: isoOffset(-2) },
        { id: 6, nama: 'Bawang merah', kategori: 'Bumbu', lokasi: 'Rak Kering', jumlah: 250, satuan: 'gram', min: 100, tanggal: isoOffset(14) },
        { id: 7, nama: 'Brokoli', kategori: 'Sayuran', lokasi: 'Kulkas', jumlah: 2, satuan: 'pcs', min: 1, tanggal: isoOffset(5) }
    ];
    var belanja = [];
    var nextId = 8, katAktif = 'Semua', lokAktif = 'Semua', hapusId = null, tglManual = false;

    var $ = function (id) { return document.getElementById(id); };
    var modalForm = new bootstrap.Modal($('modalForm'));
    var modalHapus = new bootstrap.Modal($('modalHapus'));
    var toast = new bootstrap.Toast($('toast'), { delay: 3500 });

    function opsi(sel, list) { sel.innerHTML = list.map(function (o) { return '<option>' + o + '</option>'; }).join(''); }
    opsi($('fKategori'), KATEGORI); opsi($('fLokasi'), LOKASI); opsi($('fSatuan'), SATUAN);

    function esc(s) { return String(s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }
    function info(msg) { $('toastBody').textContent = msg; toast.show(); }
    function sisaHari(tgl) { var n = new Date(); n.setHours(0, 0, 0, 0); return Math.round((new Date(tgl + 'T00:00:00') - n) / 86400000); }
    function status(tgl) {
        var s = sisaHari(tgl);
        if (s < 0) return { cls: 'b-red', teks: 'Kadaluwarsa', kode: 'exp' };
        if (s === 0) return { cls: 'b-yellow', teks: 'Hari ini', kode: 'soon' };
        if (s <= 3) return { cls: 'b-yellow', teks: s + ' hari lagi', kode: 'soon' };
        return { cls: 'b-green', teks: 'Aman', kode: 'ok' };
    }
    function teksSisa(tgl) {
        var s = sisaHari(tgl);
        return s < 0 ? 'lewat ' + (-s) + ' hari' : s === 0 ? 'hari ini' : s === 1 ? 'besok' : s + ' hari lagi';
    }
    function fmtTgl(t) { return new Date(t + 'T00:00:00').toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }); }
    function lowState(b) { return b.jumlah <= 0 ? 'habis' : (b.min > 0 && b.jumlah < b.min) ? 'tipis' : ''; }

    // Estimasi umur simpan otomatis
    function estimasiHari(nama, kat, lok) {
        var n = nama.toLowerCase(), hari = null;
        Object.keys(UMUR_NAMA).forEach(function (k) { if (hari === null && n.indexOf(k) !== -1) hari = UMUR_NAMA[k]; });
        if (hari === null) hari = UMUR_KAT[kat] || 14;
        if (lok === 'Freezer') hari *= 8;
        return hari;
    }
    function autoTanggal() {
        if (tglManual) return;
        var nama = $('fNama').value.trim();
        if (!nama) { $('fHint').classList.add('d-none'); return; }
        var h = estimasiHari(nama, $('fKategori').value, $('fLokasi').value);
        $('fTanggal').value = isoOffset(h);
        $('fHint').textContent = 'Diisi otomatis, perkiraan tahan ' + h + ' hari. Ubah jika berbeda.';
        $('fHint').classList.remove('d-none');
    }

    function chips(el, list, aktif, attr) {
        el.innerHTML = ['Semua'].concat(list).map(function (k) {
            return '<button type="button" class="ks-chip ' + (k === aktif ? 'active' : '') + '" ' + attr + '="' + esc(k) + '">' + esc(k) + '</button>';
        }).join('');
    }

    function renderBanner() {
        var dekat = data.filter(function (b) { return b.jumlah > 0 && status(b.tanggal).kode !== 'ok'; })
            .sort(function (a, b) { return a.tanggal < b.tanggal ? -1 : 1; });
        $('banner').classList.toggle('d-none', dekat.length === 0);
        $('bannerList').innerHTML = dekat.map(function (b) {
            var merah = status(b.tanggal).kode === 'exp';
            return '<span class="ks-pill ' + (merah ? 'red' : 'yellow') + '"><i class="bi bi-circle-fill" style="font-size:.5rem"></i><b>' + esc(b.nama) + '</b>' + teksSisa(b.tanggal) + '</span>';
        }).join('');
        var base = $('banner').dataset.resep;
        var bahan = dekat.filter(function (b) { return status(b.tanggal).kode !== 'exp'; }).map(function (b) { return b.nama; });
        $('bannerBtn').href = base === '#' ? '#' : base + '?bahan=' + encodeURIComponent(bahan.join(','));
    }

    function renderBelanja() {
        $('needBox').classList.toggle('d-none', belanja.length === 0);
        $('needList').textContent = belanja.join(', ');
    }

    function render() {
        var q = $('searchInput').value.trim().toLowerCase();
        var list = data.filter(function (b) {
            return (katAktif === 'Semua' || b.kategori === katAktif) && (lokAktif === 'Semua' || b.lokasi === lokAktif) && b.nama.toLowerCase().indexOf(q) !== -1;
        }).sort(function (a, b) { return a.tanggal < b.tanggal ? -1 : 1; });

        $('stokBody').innerHTML = list.map(function (b) {
            var st = status(b.tanggal), lo = lowState(b);
            var tag = lo === 'habis' ? '<span class="ks-mini b-red">Habis</span>' : lo === 'tipis' ? '<span class="ks-mini b-yellow">Menipis</span>' : '';
            return '<tr>' +
                '<td class="ks-name">' + esc(b.nama) + '</td>' +
                '<td><span class="ks-cat">' + esc(b.kategori) + '</span></td>' +
                '<td class="ks-loc"><i class="bi ' + LOK_ICON[b.lokasi] + '"></i>' + esc(b.lokasi) + '</td>' +
                '<td class="text-nowrap">' + b.jumlah + ' ' + esc(b.satuan) + tag + '</td>' +
                '<td class="text-nowrap">' + fmtTgl(b.tanggal) + '</td>' +
                '<td><span class="ks-badge ' + st.cls + '">' + st.teks + '</span></td>' +
                '<td class="text-end text-nowrap">' +
                    '<button class="ks-act use me-1" data-pakai="' + b.id + '" title="Pakai ' + STEP[b.satuan] + ' ' + b.satuan + '" aria-label="Pakai ' + esc(b.nama) + '"' + (b.jumlah <= 0 ? ' disabled' : '') + '><i class="bi bi-dash-lg"></i></button>' +
                    '<button class="ks-act me-1" data-edit="' + b.id + '" aria-label="Edit ' + esc(b.nama) + '"><i class="bi bi-pencil"></i></button>' +
                    '<button class="ks-act danger" data-hapus="' + b.id + '" aria-label="Hapus ' + esc(b.nama) + '"><i class="bi bi-trash3"></i></button>' +
                '</td></tr>';
        }).join('');
        $('emptyState').classList.toggle('d-none', list.length > 0);

        $('statTotal').textContent = data.length;
        $('statSoon').textContent = data.filter(function (b) { return status(b.tanggal).kode === 'soon'; }).length;
        $('statExpired').textContent = data.filter(function (b) { return status(b.tanggal).kode === 'exp'; }).length;
        $('statLow').textContent = data.filter(function (b) { return lowState(b) !== ''; }).length;
        renderBanner(); renderBelanja();
    }

    function bukaForm(b) {
        $('formError').classList.add('d-none');
        $('fHint').classList.add('d-none');
        $('modalTitle').textContent = b ? 'Edit Bahan' : 'Tambah Bahan';
        $('fId').value = b ? b.id : '';
        $('fNama').value = b ? b.nama : '';
        $('fKategori').value = b ? b.kategori : KATEGORI[0];
        $('fLokasi').value = b ? b.lokasi : LOKASI[0];
        $('fJumlah').value = b ? b.jumlah : '';
        $('fSatuan').value = b ? b.satuan : SATUAN[0];
        $('fMin').value = b ? b.min : 0;
        $('fTanggal').value = b ? b.tanggal : '';
        tglManual = !!b;
        modalForm.show();
    }

    function pakai(b) {
        b.jumlah = Math.max(0, Math.round((b.jumlah - STEP[b.satuan]) * 100) / 100);
        if (b.jumlah === 0) {
            if (belanja.indexOf(b.nama) === -1) belanja.push(b.nama);
            info(b.nama + ' habis dan ditambahkan ke daftar belanja.');
        } else if (lowState(b) === 'tipis') {
            info('Stok ' + b.nama + ' menipis: sisa ' + b.jumlah + ' ' + b.satuan + '.');
        }
    }

    $('btnTambah').addEventListener('click', function () { bukaForm(null); });
    $('searchInput').addEventListener('input', render);
    $('chipKat').addEventListener('click', function (e) { var c = e.target.closest('.ks-chip'); if (!c) return; katAktif = c.dataset.k; chips($('chipKat'), KATEGORI, katAktif, 'data-k'); render(); });
    $('chipLok').addEventListener('click', function (e) { var c = e.target.closest('.ks-chip'); if (!c) return; lokAktif = c.dataset.l; chips($('chipLok'), LOKASI, lokAktif, 'data-l'); render(); });

    ['fNama', 'fKategori', 'fLokasi'].forEach(function (id) { $(id).addEventListener('input', autoTanggal); });
    $('fTanggal').addEventListener('input', function () { tglManual = true; $('fHint').classList.add('d-none'); });

    $('stokBody').addEventListener('click', function (e) {
        var p = e.target.closest('[data-pakai]'), ed = e.target.closest('[data-edit]'), hp = e.target.closest('[data-hapus]');
        var find = function (id) { return data.find(function (b) { return b.id == id; }); };
        if (p) { pakai(find(p.dataset.pakai)); render(); }
        else if (ed) { bukaForm(find(ed.dataset.edit)); }
        else if (hp) { var b = find(hp.dataset.hapus); hapusId = b.id; $('hapusNama').textContent = b.nama; modalHapus.show(); }
    });

    $('formBahan').addEventListener('submit', function (e) {
        e.preventDefault();
        var item = {
            nama: $('fNama').value.trim(), kategori: $('fKategori').value, lokasi: $('fLokasi').value,
            jumlah: parseFloat($('fJumlah').value), satuan: $('fSatuan').value,
            min: parseFloat($('fMin').value) || 0, tanggal: $('fTanggal').value
        };
        if (!item.nama || isNaN(item.jumlah) || item.jumlah < 0 || !item.tanggal) { $('formError').classList.remove('d-none'); return; }
        var id = $('fId').value;
        if (id) { var i = data.findIndex(function (b) { return b.id == id; }); item.id = data[i].id; data[i] = item; }
        else { item.id = nextId++; data.push(item); }
        if (item.jumlah === 0 && belanja.indexOf(item.nama) === -1) { belanja.push(item.nama); info(item.nama + ' habis dan ditambahkan ke daftar belanja.'); }
        if (item.jumlah > 0) belanja = belanja.filter(function (n) { return n !== item.nama; });
        modalForm.hide(); render();
    });

    $('btnKonfirmasiHapus').addEventListener('click', function () { data = data.filter(function (b) { return b.id !== hapusId; }); modalHapus.hide(); render(); });

    chips($('chipKat'), KATEGORI, katAktif, 'data-k');
    chips($('chipLok'), LOKASI, lokAktif, 'data-l');
    render();
});
</script>
@endverbatim
@endsection