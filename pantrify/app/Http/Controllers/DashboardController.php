<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy dulu. Nanti ganti dengan query ke database.
        $anggaran = 500000;
        $terpakai = 325000;

        return view('dashboard.index', [
            'anggaran'     => $anggaran,
            'terpakai'     => $terpakai,
            'persen'       => (int) round($terpakai / $anggaran * 100),
            'totalStok'    => 12,
            'menuHariIni'  => [
                'nama'  => 'Ayam tumis sayuran',
                'biaya' => 15000,
                'waktu' => '25 menit',
            ],
            'stokMenipis'  => [
                ['nama' => 'Telur', 'sisa' => '2 butir', 'status' => 'warning'],
                ['nama' => 'Bayam', 'sisa' => '1 ikat',  'status' => 'danger', 'catatan' => 'Kedaluwarsa besok'],
                ['nama' => 'Beras', 'sisa' => '1,5 kg',  'status' => 'warning'],
            ],
            'tipAi' => 'Harga ayam di pasar turun minggu ini. Pertimbangkan masak lebih banyak dan simpan di freezer.',
        ]);
    }
}