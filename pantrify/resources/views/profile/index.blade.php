
@extends('layouts.app')

@section('title', 'Profil')

@section('content')
  
<style>
    .profile-page {
        background: #f3f8f4;
        min-height: 100vh;
        padding: 20px;
        color: #172b22;
    }

    .profile-page * { box-sizing: border-box; }

    .profile-heading { margin-bottom: 20px; }

    .profile-heading h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-heading p {
        font-size: 13px;
        color: #718078;
        margin: 0;
    }

    .profile-layout {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 16px;
        align-items: start;
    }

    .profile-card {
        background: white;
        border-radius: 13px;
        padding: 20px;
        border: 1px solid #edf1ee;
        margin-bottom: 15px;
    }

    .profile-avatar {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background: #ff9f43;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 29px;
        font-weight: 800;
        margin: 0 auto 12px;
        color: #35200c;
    }

    .profile-user { text-align: center; }

    .profile-user h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-user p {
        font-size: 12px;
        color: #718078;
        margin-bottom: 10px;
    }

    .profile-upload {
        border: 1px solid #17643e;
        color: #17643e;
        background: white;
        padding: 7px 17px;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
    }

    .profile-card h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .profile-form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 13px;
    }

    .profile-field label {
        display: block;
        font-size: 11px;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .profile-field input {
        width: 100%;
        border: 1px solid #d7e5dc;
        border-radius: 8px;
        padding: 9px;
        font-size: 12px;
        outline: none;
        background: white;
    }

    .profile-field input:focus {
        border-color: #17643e;
    }

    .profile-group {
        margin-bottom: 17px;
    }

    .profile-group-title {
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .profile-options {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .profile-option {
        border: 1px solid #d7e5dc;
        background: white;
        border-radius: 25px;
        padding: 8px 12px;
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .profile-option input {
        accent-color: #17643e;
        margin: 0;
    }

    .profile-dislike {
        width: 100%;
        border: 1px solid #d7e5dc;
        padding: 10px;
        border-radius: 8px;
        font-size: 12px;
        outline: none;
    }

    .profile-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 13px;
    }

    .profile-save {
        background: #ff9f43;
        border: none;
        border-radius: 9px;
        padding: 10px 20px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        color: #30200e;
    }

    .profile-save:hover { background: #f58b26; }

    @media(max-width: 700px) {
        .profile-layout { grid-template-columns: 1fr; }
        .profile-form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="profile-page">

    <div class="profile-heading">
        <h2>Profil</h2>
        <p>Informasi pengguna dan preferensi makanan.</p>
    </div>

    <form action="#" method="POST">
        @csrf

        <div class="profile-layout">

            <div class="profile-card profile-user">
                <div class="profile-avatar">SA</div>

                <h3>Sari Anggraini</h3>
                <p>sari@example.com</p>

                <label class="profile-upload">
                    Ubah foto
                    <input type="file" name="foto"
                           accept="image/*" hidden>
                </label>
            </div>

            <div>
                <div class="profile-card">
                    <h3>Informasi pengguna</h3>

                    <div class="profile-form-grid">
                        <div class="profile-field">
                            <label>Nama lengkap</label>
                            <input type="text" name="nama"
                                   value="Sari Anggraini">
                        </div>

                        <div class="profile-field">
                            <label>Email</label>
                            <input type="email" name="email"
                                   value="sari@example.com">
                        </div>

                        <div class="profile-field">
                            <label>Jumlah anggota keluarga</label>
                            <input type="number" name="anggota_keluarga"
                                   value="4" min="1">
                        </div>

                        <div class="profile-field">
                            <label>Anggaran belanja per minggu</label>
                            <input type="text" name="anggaran"
                                   value="Rp500.000">
                        </div>
                    </div>
                </div>

                <div class="profile-card">
                    <h3>Preferensi makanan</h3>

                    <div class="profile-group">
                        <div class="profile-group-title">Pola makan</div>

                        <div class="profile-options">
                            <label class="profile-option">
                                <input type="checkbox" name="pola_makan[]"
                                       value="Halal" checked> Halal
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="pola_makan[]"
                                       value="Vegetarian"> Vegetarian
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="pola_makan[]"
                                       value="Rendah gula" checked> Rendah gula
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="pola_makan[]"
                                       value="Rendah garam"> Rendah garam
                            </label>
                        </div>
                    </div>

                    <div class="profile-group">
                        <div class="profile-group-title">Alergi</div>

                        <div class="profile-options">
                            <label class="profile-option">
                                <input type="checkbox" name="alergi[]"
                                       value="Udang" checked> Udang
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="alergi[]"
                                       value="Kacang"> Kacang
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="alergi[]"
                                       value="Susu"> Susu
                            </label>

                            <label class="profile-option">
                                <input type="checkbox" name="alergi[]"
                                       value="Kedelai"> Kedelai
                            </label>
                        </div>
                    </div>

                    <div class="profile-group">
                        <div class="profile-group-title">
                            Bahan yang tidak disukai
                        </div>

                        <input class="profile-dislike"
                               type="text" name="tidak_disukai"
                               value="Pare, jeroan"
                               placeholder="Contoh: Pare, jeroan">
                    </div>

                    <div class="profile-actions">
                        <button type="submit" class="profile-save">
                            Simpan perubahan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
