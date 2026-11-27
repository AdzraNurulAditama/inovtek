<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MealPlannerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari form (jika ada), atau gunakan default
        $anggaranMingguan = $request->input('anggaran_mingguan', 350000);
        $targetKalori = $request->input('target_kalori', 1900);
        $targetProtein = $request->input('target_protein', 95);
        $preferensi = $request->input('preferensi', ['Halal', 'Masakan Nusantara']);

        // Data dummy rekomendasi menu 7 hari (bisa diganti integrasi AI/Database nantinya)
        $rencanaMenu = [
            [
                'hari' => 'Senin',
                'tanggal' => 'Hari 1',
                'total_biaya' => 42000,
                'total_kalori' => $targetKalori - 50,
                'total_protein' => $targetProtein,
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
                'total_kalori' => $targetKalori + 20,
                'total_protein' => $targetProtein + 7,
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
                'total_kalori' => $targetKalori - 100,
                'total_protein' => $targetProtein - 5,
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
                'total_kalori' => $targetKalori + 50,
                'total_protein' => $targetProtein + 10,
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
                'total_kalori' => $targetKalori - 20,
                'total_protein' => $targetProtein + 3,
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
                'total_kalori' => $targetKalori + 100,
                'total_protein' => $targetProtein + 15,
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
                'total_kalori' => $targetKalori,
                'total_protein' => $targetProtein,
                'menu' => [
                    ['waktu' => 'Sarapan', 'nama' => 'Lontong Sayur Labu & Telur Balado', 'kalori' => 500, 'protein' => 22, 'biaya' => 12000],
                    ['waktu' => 'Makan Siang', 'nama' => 'Gado-Gado Komplit & Tahu Tempe', 'kalori' => 760, 'protein' => 36, 'biaya' => 16000],
                    ['waktu' => 'Makan Malam', 'nama' => 'Tumis Daging Sapi Lada Hitam & Pakcoy', 'kalori' => 640, 'protein' => 38, 'biaya' => 16000],
                ]
            ],
        ];

        return view('meal-planner.index', compact(
            'anggaranMingguan',
            'targetKalori',
            'targetProtein',
            'preferensi',
            'rencanaMenu'
        ));
    }
}