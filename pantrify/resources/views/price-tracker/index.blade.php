
@extends('layouts.app')

@section('title', 'Price Tracker')

@section('content')

<style>
    .pt-page {
        background: #f3f8f4;
        min-height: 100vh;
        padding: 22px;
        border-radius: 16px;
        color: #172b22;
    }

    .pt-page * {
        box-sizing: border-box;
    }

    .pt-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 22px;
    }

    .pt-header h2 {
        font-size: 24px;
        font-weight: 750;
        margin-bottom: 5px;
    }

    .pt-header p {
        color: #718078;
        font-size: 13px;
        margin: 0;
    }

    .pt-search {
        width: 250px;
        border: 1px solid #dce8df;
        border-radius: 10px;
        background: white;
        padding: 10px 13px;
        font-size: 12px;
        outline: none;
    }

    .pt-search:focus {
        border-color: #17643e;
    }

    .pt-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 16px;
    }

    .pt-section-title {
        font-size: 15px;
        font-weight: 750;
        margin-bottom: 5px;
    }

    .pt-section-desc {
        color: #7b8780;
        font-size: 11px;
        margin-bottom: 16px;
    }

    .pt-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }

    .pt-summary-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 13px;
        padding: 16px;
    }

    .pt-summary-card.highlight {
        background: #fff0df;
        border-color: #ffdfbd;
    }

    .pt-summary-label {
        color: #758078;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .pt-summary-value {
        color: #17643e;
        font-size: 21px;
        font-weight: 800;
    }

    .pt-summary-card.highlight .pt-summary-value {
        color: #c66a16;
    }

    .pt-summary-note {
        font-size: 10px;
        color: #859087;
        margin-top: 4px;
    }

    .pt-table-wrap {
        overflow-x: auto;
    }

    .pt-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
        font-size: 12px;
    }

    .pt-table th {
        background: #f7faf7;
        color: #65746a;
        font-size: 11px;
        font-weight: 700;
        text-align: left;
        padding: 12px 10px;
    }

    .pt-table td {
        padding: 13px 10px;
        border-bottom: 1px solid #edf1ee;
        vertical-align: middle;
    }

    .pt-table tr:last-child td {
        border-bottom: none;
    }

    .pt-product {
        font-weight: 700;
        color: #24382d;
    }

    .pt-product small {
        display: block;
        color: #8a958d;
        font-size: 10px;
        font-weight: 400;
        margin-top: 3px;
    }

    .pt-cheapest {
        color: #087443;
        font-weight: 800;
    }

    .pt-store-badge {
        background: #e3f3e8;
        color: #17643e;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .pt-source-note {
        color: #879188;
        font-size: 10px;
        margin-top: 12px;
    }

    .pt-substitute-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .pt-substitute {
        border: 1px solid #e5eee7;
        border-radius: 12px;
        padding: 15px;
        background: #fff;
    }

    .pt-substitute-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .pt-substitute h4 {
        font-size: 13px;
        font-weight: 750;
        margin: 0;
    }

    .pt-tag {
        font-size: 10px;
        padding: 5px 8px;
        border-radius: 20px;
        background: #e3f3e8;
        color: #17643e;
        white-space: nowrap;
    }

    .pt-substitute p {
        font-size: 11px;
        color: #718078;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .pt-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        margin-bottom: 12px;
    }

    .pt-saving {
        color: #d66c12;
        font-weight: 800;
    }

    .pt-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pt-btn-primary,
    .pt-btn-outline {
        display: inline-block;
        text-decoration: none;
        text-align: center;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 11px;
        font-weight: 700;
        flex: 1;
    }

    .pt-btn-primary {
        color: white;
        background: #17643e;
        border: 1px solid #17643e;
    }

    .pt-btn-primary:hover {
        background: #104c2e;
        color: white;
    }

    .pt-btn-outline {
        color: #17643e;
        background: white;
        border: 1px solid #17643e;
    }

    .pt-btn-outline:hover {
        background: #eaf5ed;
        color: #104c2e;
    }

    .pt-info {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        background: #edf6ef;
        border: 1px solid #dcecdf;
        border-radius: 12px;
        padding: 14px;
        font-size: 11px;
        color: #42634e;
        line-height: 1.6;
    }

    .pt-info i {
        font-size: 18px;
        color: #17643e;
    }

    @media(max-width: 750px) {
        .pt-header {
            flex-direction: column;
        }

        .pt-search {
            width: 100%;
        }

        .pt-summary {
            grid-template-columns: 1fr;
        }

        .pt-substitute-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pt-page">

    <!-- HEADER -->
    <div class="pt-header">
        <div>
            <h2>
                <i class="bi bi-tags text-success me-2"></i>
                Price Tracker
            </h2>
            <p>
                Bandingkan harga bahan makanan dan temukan alternatif yang lebih hemat.
            </p>
        </div>

        <input type="text"
               class="pt-search"
               placeholder="Cari bahan makanan...">
    </div>

    <!-- RINGKASAN HARGA -->
    <div class="pt-summary">

        <div class="pt-summary-card">
            <div class="pt-summary-label">Total Harga Termurah</div>
            <div class="pt-summary-value">Rp163.900</div>
            <div class="pt-summary-note">Gabungan harga termurah dari beberapa toko</div>
        </div>

        <div class="pt-summary-card">
            <div class="pt-summary-label">Harga Termurah Satu Toko</div>
            <div class="pt-summary-value">Rp169.000</div>
            <div class="pt-summary-note">Jika seluruh bahan dibeli di satu toko</div>
        </div>

        <div class="pt-summary-card highlight">
            <div class="pt-summary-label">Potensi Penghematan</div>
            <div class="pt-summary-value">Rp5.100</div>
            <div class="pt-summary-note">Dengan membandingkan harga antar toko</div>
        </div>

    </div>

    <!-- KEBUTUHAN BAHAN -->
    <div class="pt-card">

        <h3 class="pt-section-title">
            <i class="bi bi-basket2 text-success me-2"></i>
            Kebutuhan Bahan dari Meal Planner
        </h3>

        <p class="pt-section-desc">
            Daftar bahan yang dibutuhkan berdasarkan rencana menu pengguna.
        </p>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

            <div>
                <div class="fw-bold small">Menu Mingguan</div>
                <div class="text-muted" style="font-size:11px">
                    5 bahan perlu dibandingkan harganya
                </div>
            </div>

            <a href="{{ route('meal-planner') }}"
               class="pt-btn-outline"
               style="flex:0 0 auto">
                <i class="bi bi-journal-richtext me-1"></i>
                Lihat Meal Planner
            </a>

        </div>

    </div>

    <!-- PERBANDINGAN HARGA -->
    <div class="pt-card">

        <h3 class="pt-section-title">
            <i class="bi bi-bar-chart-line text-success me-2"></i>
            Perbandingan Harga Bahan
        </h3>

        <p class="pt-section-desc">
            Harga contoh dari tiga toko untuk bahan dengan jenis dan satuan yang sama.
        </p>

        <div class="pt-table-wrap">

            <table class="pt-table">

                <thead>
                    <tr>
                        <th>Bahan</th>
                        <th>Toko A</th>
                        <th>Toko B</th>
                        <th>Toko C</th>
                        <th>Harga Termurah</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td class="pt-product">
                            Beras
                            <small>5 kg</small>
                        </td>
                        <td>Rp74.500</td>
                        <td class="pt-cheapest">Rp72.000</td>
                        <td>Rp76.000</td>
                        <td><span class="pt-store-badge">Toko B</span></td>
                    </tr>

                    <tr>
                        <td class="pt-product">
                            Telur Ayam
                            <small>1 kg</small>
                        </td>
                        <td>Rp29.000</td>
                        <td>Rp31.000</td>
                        <td class="pt-cheapest">Rp28.500</td>
                        <td><span class="pt-store-badge">Toko C</span></td>
                    </tr>

                    <tr>
                        <td class="pt-product">
                            Minyak Goreng
                            <small>1 liter</small>
                        </td>
                        <td>Rp19.500</td>
                        <td class="pt-cheapest">Rp18.900</td>
                        <td>Rp20.000</td>
                        <td><span class="pt-store-badge">Toko B</span></td>
                    </tr>

                    <tr>
                        <td class="pt-product">
                            Dada Ayam
                            <small>500 gram</small>
                        </td>
                        <td>Rp27.000</td>
                        <td>Rp29.500</td>
                        <td class="pt-cheapest">Rp26.000</td>
                        <td><span class="pt-store-badge">Toko C</span></td>
                    </tr>

                    <tr>
                        <td class="pt-product">
                            Susu Sapi
                            <small>1 liter</small>
                        </td>
                        <td>Rp19.000</td>
                        <td class="pt-cheapest">Rp18.500</td>
                        <td>Rp21.000</td>
                        <td><span class="pt-store-badge">Toko B</span></td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="pt-source-note">
            <i class="bi bi-info-circle me-1"></i>
            Data harga merupakan simulasi frontend. Pada implementasi berikutnya, data dapat berasal dari scan struk, input admin, atau sumber harga toko.
        </div>

    </div>

    <!-- SMART SUBSTITUTE -->
    <div class="pt-card">

        <h3 class="pt-section-title">
            <i class="bi bi-lightbulb text-warning me-2"></i>
            Smart Substitute
        </h3>

        <p class="pt-section-desc">
            Rekomendasi bahan pengganti berdasarkan fungsi bahan, kategori, dan pertimbangan harga.
        </p>

        <div class="pt-substitute-grid">

            <!-- ALTERNATIF AYAM -->
            <div class="pt-substitute">

                <div class="pt-substitute-top">
                    <h4>Ayam → Tempe</h4>
                    <span class="pt-tag">Protein nabati</span>
                </div>

                <p>
                    Tempe dapat menjadi pilihan protein nabati yang lebih hemat.
                    Kandungan gizi dan takaran pengganti berbeda dari ayam.
                </p>

                <div class="pt-price-row">
                    <span>Ayam: Rp38.000/kg</span>
                    <strong>Tempe: Rp16.000/kg</strong>
                </div>

                <div class="pt-saving">
                    Potensi hemat Rp22.000/kg
                </div>

                <div class="pt-actions mt-3">

                    <a href="{{ route('meal-planner') }}"
                       class="pt-btn-primary">
                        Lihat di Meal Planner
                    </a>

                    <a href="{{ route('daftar-belanja') }}"
                       class="pt-btn-outline">
                        Daftar Belanja
                    </a>

                </div>

            </div>

            <!-- ALTERNATIF TELUR -->
            <div class="pt-substitute">

                <div class="pt-substitute-top">
                    <h4>Telur → Tahu</h4>
                    <span class="pt-tag">Protein nabati</span>
                </div>

                <p>
                    Tahu dapat menjadi alternatif sumber protein nabati.
                    Pengguna perlu menyesuaikan jumlah dan cara pengolahannya.
                </p>

                <div class="pt-price-row">
                    <span>Telur: Rp28.500/kg</span>
                    <strong>Tahu: Rp12.000/kg</strong>
                </div>

                <div class="pt-saving">
                    Alternatif dengan harga lebih rendah
                </div>

                <div class="pt-actions mt-3">

                    <a href="{{ route('meal-planner') }}"
                       class="pt-btn-primary">
                        Lihat di Meal Planner
                    </a>

                    <a href="{{ route('daftar-belanja') }}"
                       class="pt-btn-outline">
                        Daftar Belanja
                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- INFORMASI SUMBER DATA -->
    <div class="pt-info">

        <i class="bi bi-info-circle-fill"></i>

        <div>
            <strong>Dari mana data harga diperoleh?</strong><br>
            Pantrify dapat mengumpulkan harga dari hasil scan struk pengguna,
            input harga oleh admin, atau integrasi sumber harga toko.
            Setiap harga perlu memiliki informasi sumber dan tanggal pembaruan
            agar pengguna dapat menilai apakah data masih relevan.
        </div>

    </div>

</div>

@endsection
