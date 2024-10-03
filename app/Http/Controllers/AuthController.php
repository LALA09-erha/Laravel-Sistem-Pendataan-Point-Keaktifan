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
        // mengambil data userModel dan mengaambil yang role dosen
        $dosen = UsersModel::where('role', 'Dosen')->get();

        if(session('user')){
            return redirect('/');
        }else{
            return view('auth.register', ['title' => 'Register | Sistem Pendataan Keaktifan Mahasiswa', 'dosen' => $dosen]);
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
                'nip_dosen' => $request->dosen,
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
    public function edit(Request $request)
    {
        try{
        $role = $request->role;
        if($role == 'Dosen'){
            $data_dosen = UsersModel::where('nip', $request->nip)->get()[0];
            
            if($request->email == $data_dosen->email && $request->password == $data_dosen->password && $request->name == $data_dosen->name){
                return redirect('/data-dosen')->with('error', 'Data Dosen Tidak Berubah');
            }else{

                if($request->password != $data_dosen->password){

                UsersModel::where('nip', $request->nip)->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => $request->name
                ]);                
                }else{

                    UsersModel::where('nip', $request->nip)->update([
                        'email' => $request->email,
                        'name' => $request->name
                    ]);
                }

                // update session 'user' dengan data yang baru dari database users
                $request->session()->put('user', UsersModel::where('nip', $request->nip)->get()[0]);
                return redirect('/data-dosen')->with('message', 'Data Dosen Berhasil Berubah');
            }

            
        }else{
            $mahasiswa = MahasiswaModel::where('nim', $request->nim)->get()[0];
            
            if($request->email == $mahasiswa->email && $request->password == $mahasiswa->password && $request->name == $mahasiswa->name){
                return redirect('/')->with('message', 'Data Tidak Berubah');
            }else{
                if($request->password != $mahasiswa->password){
                    MahasiswaModel::where('nim', $request->nim)->update([
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'name' => $request->name
                    ]);
                }else{

                    MahasiswaModel::where('nim', $request->nim)->update([
                        'email' => $request->email,
                        'name' => $request->name
                    ]);
                }

                // update session 'user' dengan data yang baru dari database users
                $request->session()->put('user', MahasiswaModel::where('nim', $request->nim)->get()[0]);
                return redirect('/')->with('message', 'Data Berhasil Berubah ');
            }
        }}catch(\Exception $e){
            return redirect('/')->with('message', 'Data gagal Dirubah');
        }
        
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
