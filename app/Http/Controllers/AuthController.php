<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (session('user')) {
            return redirect('/');
        } else {
            return view('auth.login',  ['title' => 'Login | Sistem Pendataan Keaktifan Mahasiswa']);
        }
    }

    public function proseslogin(Request $request)
    {
        // mengambil data dari form login
        $nim = $request->nim;
        $password = $request->password;

        // mencari data mahasiswa/dosen berdasarkan nim
        $mahasiswa = MahasiswaModel::where('nim', $nim)->first();
        if ($mahasiswa) {
            // cek apakah password benar
            if (Hash::check($password, $mahasiswa->password)) {
                // jika benar, simpan data dosen ke session dan redirect ke halaman home
                $request->session()->put('user', $mahasiswa);
                return redirect('/')->with('message', 'Anda berhasil login');
            } else {
                // jika password salah, redirect ke halaman login dengan pesan error
                return redirect('/login')->with('message', 'NIM dan Password tidak valid 🔒');
            }
        } else {
            // cek apakah dosen ada
            $dosen = UsersModel::where('nip', $nim)->first();
            if ($dosen) {
                // cek apakah password benar
                if (Hash::check($password, $dosen->password)) {
                    // jika benar, simpan data dosen ke session dan redirect ke halaman home
                    $request->session()->put('user', $dosen);
                    return redirect('/')->with('message', 'Anda berhasil login');
                } else {
                    // jika password salah, redirect ke halaman login dengan pesan error
                    return redirect('/login')->with('message', 'NIM dan Password tidak valid 🔒');
                }
            } else {
                // jika tidak ada, redirect ke halaman login dengan pesan error
                return redirect('/login')->with('message', 'NIM dan Password tidak valid 🔒');
            }
        }
    }

    // register view page
    public function register(){
        if(session('user')){
            return redirect('/');
        }else{
            return view('auth.register', ['title' => 'Register | Sistem Pendataan Keaktifan Mahasiswa']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tambahkan data mahasiswa ke database dengan model

        try{
            $mahasiswa = new MahasiswaModel();
            
            $data =[
                'nim' => $request->nim,
                'password' => Hash::make($request->password),
                'role' => 'Mahasiswa',
                'name' => $request->nama,
                'email' => $request->email,
                'prodi' => $request->prodi,
                // 'tahun_ajaran' => $request->tahun_ajaran,
                'total_point' => 0
            ];

            // mengecek apakah nim sudah terdaftar
            $cek = MahasiswaModel::where('nim', $request->nim)->first();
            if($cek){
                return redirect('/register')->with('message', 'Data gagal ditambahkan');
            }

            // jika tidak, simpan data mahasiswa

            $mahasiswa->insert($data);
            return redirect('/login')->with('message', 'Data berhasil ditambahkan');

        }catch(\Exception $e){
            dd($e);
            return redirect('/register')->with('message', 'Data gagal ditambahkan');
        }
        // redirect ke halaman login

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // menghapus data user dari session
        session()->forget('user');
        $request->session()->flush();

        return redirect('/login')->with('message', 'Anda telah logout 🚪');
    }
}
