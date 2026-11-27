@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')

<style>
    .notif-page {
        background: #f3f8f4;
        min-height: 100vh;
        padding: 22px;
        border-radius: 16px;
        color: #172b22;
    }

    .notif-page * {
        box-sizing: border-box;
    }

    .notif-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 22px;
    }

    .notif-header h2 {
        font-size: 24px;
        font-weight: 750;
        margin-bottom: 5px;
    }

    .notif-header p {
        color: #718078;
        font-size: 13px;
        margin: 0;
    }

    .notif-count {
        background: #ffead5;
        color: #a45b17;
        border-radius: 20px;
        padding: 8px 13px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .notif-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 245px;
        gap: 16px;
        align-items: start;
    }

    .notif-section {
        margin-bottom: 20px;
    }

    .notif-section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 11px;
    }

    .notif-section-title h3 {
        font-size: 14px;
        font-weight: 750;
        margin: 0;
    }

    .notif-section-title span {
        color: #879188;
        font-size: 10px;
    }

    .notif-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px;
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 13px;
        margin-bottom: 9px;
        text-decoration: none;
        color: inherit;
        transition: all .2s ease;
    }

    .notif-item:hover {
        border-color: #a8cbb2;
        box-shadow: 0 4px 12px rgba(23, 100, 62, .07);
        transform: translateY(-1px);
        color: inherit;
    }

    .notif-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .notif-icon.orange {
        background: #fff0df;
        color: #d97706;
    }

    .notif-icon.green {
        background: #e3f3e8;
        color: #17643e;
    }

    .notif-icon.blue {
        background: #e8f1ff;
        color: #3972b8;
    }

    .notif-icon.red {
        background: #fde8e7;
        color: #c94b45;
    }

    .notif-content {
        flex: 1;
        min-width: 0;
    }

    .notif-content h4 {
        font-size: 12px;
        font-weight: 750;
        margin: 0 0 5px;
    }

    .notif-content p {
        color: #748078;
        font-size: 11px;
        line-height: 1.5;
        margin: 0 0 6px;
    }

    .notif-meta {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .notif-source {
        color: #17643e;
        font-size: 10px;
        font-weight: 700;
    }

    .notif-time {
        color: #9aa39c;
        font-size: 10px;
    }

    .notif-arrow {
        color: #91a096;
        font-size: 15px;
        flex-shrink: 0;
    }

    .notif-sidebar-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 13px;
        padding: 16px;
        margin-bottom: 13px;
    }

    .notif-sidebar-card h3 {
        font-size: 13px;
        font-weight: 750;
        margin-bottom: 13px;
    }

    .notif-summary {
        background: #17643e;
        color: white;
        border: none;
    }

    .notif-summary h3 {
        color: white;
    }

    .notif-summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        padding: 9px 0;
        border-bottom: 1px solid rgba(255,255,255,.16);
    }

    .notif-summary-row:last-child {
        border-bottom: none;
    }

    .notif-summary-row strong {
        font-size: 13px;
    }

    .notif-settings-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        padding: 10px 0;
        border-bottom: 1px solid #edf1ee;
        font-size: 11px;
    }

    .notif-settings-row:last-child {
        border-bottom: none;
    }

    .notif-settings-row input {
        accent-color: #17643e;
        width: 15px;
        height: 15px;
    }

    .notif-settings-note {
        color: #8a958d;
        font-size: 10px;
        line-height: 1.5;
        margin-top: 10px;
    }

    .notif-help {
        background: #fff0df;
        border: 1px solid #ffdfbd;
        border-radius: 12px;
        padding: 14px;
        color: #87501e;
        font-size: 11px;
        line-height: 1.6;
    }

    .notif-help i {
        font-size: 17px;
        margin-right: 5px;
    }

    @media(max-width: 800px) {
        .notif-layout {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 550px) {
        .notif-header {
            flex-direction: column;
        }

        .notif-item {
            padding: 12px;
            gap: 9px;
        }

        .notif-icon {
            width: 36px;
            height: 36px;
        }
    }
</style>

<div class="notif-page">

    <!-- HEADER -->
    <div class="notif-header">

        <div>
            <h2>
                <i class="bi bi-bell text-success me-2"></i>
                Notifikasi
            </h2>

            <p>
                Semua pengingat dan informasi penting dari aktivitas Pantrify.
            </p>
        </div>

        <span class="notif-count">
            5 Pemberitahuan
        </span>

    </div>

    <div class="notif-layout">

        <!-- DAFTAR NOTIFIKASI -->
        <div>

            <!-- STOK DAPUR -->
            <div class="notif-section">

                <div class="notif-section-title">
                    <h3>
                        <i class="bi bi-box-seam text-success me-2"></i>
                        Stok Dapur
                    </h3>
                    <span>2 pemberitahuan</span>
                </div>

                <a href="{{ route('stok-dapur') }}" class="notif-item">

                    <div class="notif-icon orange">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Stok Telur Hampir Habis</h4>

                        <p>
                            Stok telur tersisa 2 butir. Batas minimum yang ditentukan adalah 5 butir.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Buka Stok Dapur</span>
                            <span class="notif-time">Hari ini · 08.00</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

                <a href="{{ route('stok-dapur') }}" class="notif-item">

                    <div class="notif-icon red">
                        <i class="bi bi-calendar-x"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Susu Segera Kedaluwarsa</h4>

                        <p>
                            Susu di dapur akan kedaluwarsa besok. Segera periksa dan gunakan sebelum tanggal tersebut.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Buka Stok Dapur</span>
                            <span class="notif-time">Hari ini · 07.30</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

            </div>

            <!-- DAFTAR BELANJA -->
            <div class="notif-section">

                <div class="notif-section-title">
                    <h3>
                        <i class="bi bi-cart3 text-success me-2"></i>
                        Daftar Belanja
                    </h3>
                    <span>1 pemberitahuan</span>
                </div>

                <a href="{{ route('daftar-belanja') }}" class="notif-item">

                    <div class="notif-icon orange">
                        <i class="bi bi-cart-check"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Waktunya Belanja Mingguan!</h4>

                        <p>
                            Ada 3 bahan yang belum mencukupi kebutuhan menu minggu ini. Periksa daftar belanjamu.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Buka Daftar Belanja</span>
                            <span class="notif-time">Hari ini · 07.00</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

            </div>

            <!-- PRICE TRACKER -->
            <div class="notif-section">

                <div class="notif-section-title">
                    <h3>
                        <i class="bi bi-tags text-success me-2"></i>
                        Price Tracker
                    </h3>
                    <span>1 pemberitahuan</span>
                </div>

                <a href="{{ route('price-tracker') }}" class="notif-item">

                    <div class="notif-icon green">
                        <i class="bi bi-graph-down-arrow"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Ditemukan Harga Lebih Hemat</h4>

                        <p>
                            Harga minyak goreng di Toko B lebih murah dibandingkan harga yang tercatat sebelumnya.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Bandingkan Harga</span>
                            <span class="notif-time">Hari ini · 06.30</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

            </div>

            <!-- ANGGARAN -->
            <div class="notif-section">

                <div class="notif-section-title">
                    <h3>
                        <i class="bi bi-wallet2 text-success me-2"></i>
                        Anggaran
                    </h3>
                    <span>1 pemberitahuan</span>
                </div>

                <a href="{{ route('anggaran') }}" class="notif-item">

                    <div class="notif-icon blue">
                        <i class="bi bi-pie-chart"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Anggaran Mingguan Hampir Habis</h4>

                        <p>
                            Pengeluaran belanja sudah mencapai 85% dari anggaran mingguan.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Lihat Anggaran</span>
                            <span class="notif-time">Kemarin · 17.00</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

            </div>

            <!-- MEAL PLANNER -->
            <div class="notif-section">

                <div class="notif-section-title">
                    <h3>
                        <i class="bi bi-journal-richtext text-success me-2"></i>
                        Meal Planner
                    </h3>
                    <span>1 pemberitahuan</span>
                </div>

                <a href="{{ route('meal-planner') }}" class="notif-item">

                    <div class="notif-icon green">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <div class="notif-content">

                        <h4>Periksa Rencana Menu Minggu Depan</h4>

                        <p>
                            Perbarui kebutuhan bahan agar daftar belanja mingguan dapat dihitung dengan tepat.
                        </p>

                        <div class="notif-meta">
                            <span class="notif-source">Buka Meal Planner</span>
                            <span class="notif-time">Kemarin · 15.00</span>
                        </div>

                    </div>

                    <i class="bi bi-chevron-right notif-arrow"></i>

                </a>

            </div>

        </div>

        <!-- SIDEBAR KANAN -->
        <div>

            <!-- RINGKASAN -->
            <div class="notif-sidebar-card notif-summary">

                <h3>
                    <i class="bi bi-clipboard-data me-2"></i>
                    Ringkasan Pemberitahuan
                </h3>

                <div class="notif-summary-row">
                    <span>Stok perlu perhatian</span>
                    <strong>2</strong>
                </div>

                <div class="notif-summary-row">
                    <span>Kebutuhan belanja</span>
                    <strong>3 bahan</strong>
                </div>

                <div class="notif-summary-row">
                    <span>Informasi harga</span>
                    <strong>1</strong>
                </div>

                <div class="notif-summary-row">
                    <span>Anggaran</span>
                    <strong>85%</strong>
                </div>

            </div>

            <!-- PENGATURAN -->
            <div class="notif-sidebar-card">

                <h3>
                    <i class="bi bi-gear text-success me-2"></i>
                    Preferensi Notifikasi
                </h3>

                <label class="notif-settings-row">
                    <span>Stok menipis</span>
                    <input type="checkbox" checked>
                </label>

                <label class="notif-settings-row">
                    <span>Kedaluwarsa</span>
                    <input type="checkbox" checked>
                </label>

                <label class="notif-settings-row">
                    <span>Pengingat belanja</span>
                    <input type="checkbox" checked>
                </label>

                <label class="notif-settings-row">
                    <span>Perubahan harga</span>
                    <input type="checkbox" checked>
                </label>

                <label class="notif-settings-row">
                    <span>Anggaran</span>
                    <input type="checkbox" checked>
                </label>

                <div class="notif-settings-note">
                    Pengaturan ini masih berupa tampilan frontend dan belum disimpan ke database.
                </div>

            </div>

            <!-- INFORMASI -->
            <div class="notif-help">

                <strong>
                    <i class="bi bi-lightbulb"></i>
                    Bagaimana notifikasi bekerja?
                </strong>

                <p class="mb-0 mt-2">
                    Pantrify memantau data stok, kebutuhan menu, jadwal belanja,
                    anggaran, dan harga. Ketika suatu kondisi terpenuhi,
                    sistem akan membuat pemberitahuan untuk pengguna.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection