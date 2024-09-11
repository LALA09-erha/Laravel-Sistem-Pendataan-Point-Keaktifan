<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UsersModel;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users_models')->insert([
            'nip' => '197406192006041003',
            'name' => 'Prof. Dr. Ir. H. Asep Kadarohman, M.Si.',
            'email' => '197406192006041003@trunoyojo.ac.id',
            'password' => bcrypt('197406192006041003'),
            'role' => 'Admin',
        ]);


        DB::table('users_models')->insert([
            'nip' => '207406202006041003',
            'name' => 'Cahyo Prayogo, S.Kom., M.Kom.',
            'email' => '207406202006041003@trunoyojo.ac.id',
            'password' => bcrypt('207406202006041003'),
            'role' => 'Dosen',
        ]);

        DB::table('mahasiswa_models')->insert([
            'nim' => '201810370311003',
            'name' => 'Muhammad Fauzan',
            'email' => '201810370311003@student.trunohoyo.ac.id',
            'password' => bcrypt('201810370311003'),
            'role' => 'Mahasiswa',
            'tahun_ajaran' => '2020',
            'prodi' => 'Teknik Informatika',
            'total_point' => 0,
        ]);
        DB::table('kedudukan_models')->insert([
            'nama_kedudukan' => 'Ketua',
        ]);
        DB::table('kedudukan_models')->insert([
            'nama_kedudukan' => 'Wakil Ketua',
        ]);
        DB::table('kedudukan_models')->insert([
            'nama_kedudukan' => '-',
        ]);
        DB::table('subkategori_models')->insert([
            'nama_subkategori' => 'Pembentukan karakter',
        ]);
        DB::table('subkategori_models')->insert([
                'nama_subkategori' => 'Pengenalan Hidup Kampus',   
        ]);
        DB::table('subkategori_models')->insert([
            'nama_subkategori' => 'Organisasi Kepemimpinan',
        ]);
        DB::table('subkategori_models')->insert([
            'nama_subkategori' => 'Lainnya',
        ]);

        DB::table('keaktifan_mahasiswa_models')->insert([
            'nim' => '201810370311003',
            'nama_mahasiswa' => 'Muhammad Fauzan',
            'tanggal_kegiatan' => new DateTime(),
            'data_kegiatan' => 'Lomba IT',
            'kedudukan_kegiatan' => 'Ketua',
            'tingkat_kegiatan' => 'Jurusan',
            'subkategori_kegiatan' => 'pengenalan hidup kampus',
            'tahun_kegiatan' => '2020',
            'kategori_kegiatan' => 'Pilihan',
            'file_kegiatan' => 'lomba-it.pdf',
            'point_kegiatan' => 10,
            'status' => 'Menunggu',
        ]);
        DB::table('keaktifan_mahasiswa_models')->insert([
            'nim' => '201810370311003',
            'nama_mahasiswa' => 'Muhammad Fauzan',
            'tanggal_kegiatan' => new DateTime(),
            'data_kegiatan' => 'Lomba IT',
            'kedudukan_kegiatan' => 'Wakil Ketua',
            'tingkat_kegiatan' => 'Jurusan',
            'subkategori_kegiatan' => 'pengenalan hidup kampus',
            'tahun_kegiatan' => '2020',
            'kategori_kegiatan' => 'Pilihan',
            'file_kegiatan' => 'lomba-it.pdf',
            'point_kegiatan' => 20,
            'status' => 'Menunggu',
        ]);
        
        DB::table('profil_ttd_models')->insert([
            'nip' => '198301182008121001',
            'nama' => ' Faikul Umam, S.T., M.T',
            'jabatan' => 'Dekan Fakultas Teknik',
            
        ]);


        DB::table('kegiatan_models')->insert([
            'nama_kegiatan' => 'Lomba IT',
            'kategori_kegiatan' => 'Pilihan',
            'subkategori_kegiatan' => 'Pembentukan karakter',
            'kedudukan_kegiatan' => 'Wakil Ketua',
            'tingkat_kegiatan' => 'Jurusan',
            'point_kegiatan' => 20,
        ]);

        DB::table('kegiatan_models')->insert([
            'nama_kegiatan' => 'PKKMB',
            'kategori_kegiatan' => 'Wajib',
            'subkategori_kegiatan' => 'Pengenalan Hidup Kampus',
            'kedudukan_kegiatan' => '-',
            'tingkat_kegiatan' => 'Universitas/Kab/Kota',
            'point_kegiatan' => 10,
        ]);

        DB::table('kegiatan_models')->insert([
            'nama_kegiatan' => 'Keaktifitas Mahasiswa (UKM)',
            'kategori_kegiatan' => 'Pilihan',
            'subkategori_kegiatan' => 'Organisasi Kepemimpinan',
            'kedudukan_kegiatan' => 'Ketua',
            'tingkat_kegiatan' => 'Fakultas',
            'point_kegiatan' => 20
        ]);
        
        DB::table('kegiatan_models')->insert([
            'nama_kegiatan' => '-',
            'kategori_kegiatan' => 'Pilihan',
            'subkategori_kegiatan' => 'Lainnya',
            'kedudukan_kegiatan' => '-',
            'tingkat_kegiatan' => '-',
            'point_kegiatan' => 20
        ]);
        
        

    }
}
