<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiFactory extends Factory
{
    private static array $matakuliah = [
        ['kode' => 'MK001', 'nama' => 'Pemrograman Web',          'sks' => 3],
        ['kode' => 'MK002', 'nama' => 'Basis Data',               'sks' => 3],
        ['kode' => 'MK003', 'nama' => 'Algoritma & Pemrograman',  'sks' => 4],
        ['kode' => 'MK004', 'nama' => 'Jaringan Komputer',        'sks' => 3],
        ['kode' => 'MK005', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
        ['kode' => 'MK006', 'nama' => 'Kecerdasan Buatan',        'sks' => 3],
        ['kode' => 'MK007', 'nama' => 'Sistem Operasi',           'sks' => 3],
        ['kode' => 'MK008', 'nama' => 'Matematika Diskrit',       'sks' => 3],
    ];

    public function definition(): array
    {
        $mk = fake()->randomElement(self::$matakuliah);
        $nilaiAngka = fake()->randomFloat(2, 45, 100);
        $tahunAkademik = fake()->numberBetween(2020, 2024);

        return [
            'mahasiswa_id'   => Mahasiswa::inRandomOrder()->value('id')
                ?? Mahasiswa::firstOrCreate(
                    ['nim' => '0000000000'],
                    [
                        'prodi_id' => \App\Models\Prodi::inRandomOrder()->value('id')
                            ?? \App\Models\Prodi::firstOrCreate(
                                ['kode_prodi' => 'DEFAULT'],
                                ['nama_prodi' => 'Prodi Default', 'jenjang' => 'S1', 'status' => 'aktif']
                            )->id,
                        'nama'     => 'Mahasiswa Default',
                        'email'    => 'default@example.com',
                        'angkatan' => 2020,
                        'status'   => 'aktif',
                        'no_hp'    => '08000000000',
                        'alamat'   => '-',
                    ]
                )->id,
            'kode_mk' => $mk['kode'],
            'nama_mk' => $mk['nama'],
            'sks' => $mk['sks'],
            'nilai_angka' => $nilaiAngka,
            'nilai_huruf' => Nilai::konversiHuruf($nilaiAngka),
            'semester' => fake()->randomElement(['Ganjil', 'Genap']),
            'tahun_akademik' => $tahunAkademik,
        ];
    }
}
