<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UsersModel;
use Illuminate\Database\Seeder;
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

        DB::table('keaktifan_mahasiswa_models')->insert([
            'nim' => '201810370311003',
            'nama_mahasiswa' => 'Muhammad Fauzan',
            'semester' => '2',
            'data_kegiatan' => 'Lomba IT | Peserta',
            'file_kegiatan' => 'lomba-it.pdf',
            'point_kegiatan' => 10,
            'status' => 'Menunggu',
        ]);
        DB::table('keaktifan_mahasiswa_models')->insert([
            'nim' => '201810370311003',
            'nama_mahasiswa' => 'Muhammad Fauzan',
            'semester' => '3',
            'data_kegiatan' => 'Lomba IT | Peserta',
            'file_kegiatan' => 'lomba-it.pdf',
            'point_kegiatan' => 20,
            'status' => 'Menunggu',
        ]);

        // get 10 random users and assign them to random roles
        // $users = UsersModel::inRandomOrder()->limit(10)->get();
    }
}
