<?php

namespace App\Http\Controllers;

use App\Models\KedudukanModel;
use App\Models\KegiatanModel;
use App\Models\SubkategoriModel;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('user')) {
            return redirect('/login');
        }

        // check if user is logged in
        if (session('user')['role'] == 'Admin') {
            // get all data from KegiatanModel
            $kegiatan = KegiatanModel::all();

            // get all data from subkategoriModel
            $subkegiatan = SubkategoriModel::all();

            // get all data from keduanganModel
            $kedudukan = KedudukanModel::all();

            // return view with data
            return view('home.kegiatan', ['kegiatans' => $kegiatan, 'title' => 'Daftar Kegiatan | Sistem Pendataan Keaktifan Mahasiswa', 'kedudukans' => $kedudukan , 'subkategoris' => $subkegiatan]);
        } else {
            // if user is not logged in, redirect to login page
            return redirect('/login');
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

        if (!session('user')) {
            return redirect('/login');
        }
        // check if user is logged in
        if (session('user')['role'] == 'Admin') {
            // validate request
            $request->validate([
                'nama_kegiatan' => 'required',
                'kategori_kegiatan' => 'required',
                'kedudukan_kegiatan' => 'required',
                'point_kegiatan' => 'required',
                'tingkat_kegiatan' => 'required',

            ]);

            


            $data = [
             'nama_kegiatan' => $request->nama_kegiatan,
            'kategori_kegiatan' => $request->kategori_kegiatan,
            'subkategori_kegiatan' => $request->subkategori_kegiatan,
            'kedudukan_kegiatan' => $request->kedudukan_kegiatan,
            'point_kegiatan' => $request->point_kegiatan,
            'tingkat_kegiatan' => $request->tingkat_kegiatan,
            'tahun_kegiatan' => null
            ];

            if($request->subkategori_kegiatan == 'Lainnya'){
                $data_kegiatan = KegiatanModel::where('subkategori_kegiatan', $request->subkategori_kegiatan)->get();
                if ($data_kegiatan->count() > 0) {
                    // if data already exists, redirect to kegiatan page
                    return redirect('/kegiatan')->with('message', 'Kegiatan sudah ada');
                }
            }

            
            // checkk if data already exists
            $data_kegiatan = KegiatanModel::where('nama_kegiatan', $request->nama_kegiatan)->where('subkategori_kegiatan', $request->subkategori_kegiatan)->where('kedudukan_kegiatan', $request->kedudukan_kegiatan)->where('tingkat_kegiatan', $request->tingkat_kegiatan)->get();
            if ($data_kegiatan->count() > 0) {
                // if data already exists, redirect to kegiatan page
                return redirect('/kegiatan')->with('message', 'Kegiatan sudah ada');
            }else{
                // if data does not exist, insert data
                $kegiatan = KegiatanModel::create($data);

                // redirect to kegiatan page
                return redirect('/kegiatan')->with('message', 'Kegiatan berhasil ditambahkan');

            }
        } else {
            // if user is not logged in, redirect to login page
            return redirect('/login')->with('message', 'Silahkan login terlebih dahulu');
        }
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
    public function update(Request $request)
    {
        // ambil data dari request
        $id = $request->id;
        $nama_kegiatan = $request->nama_kegiatan;
        $kategori_kegiatan = $request->kategori_kegiatan;
        $subkategori_kegiatan = $request->subkategori_kegiatan;
        $kedudukan_kegiatan = $request->kedudukan_kegiatan;
        $point_kegiatan = $request->point_kegiatan;
        $tingkat_kegiatan = $request->tingkat_kegiatan;
        $tahun_kegiatan = null;

        
        // check apakah ada yang berubah dari data kegiatan berdasarkan id
        $kegiatan = KegiatanModel::where('id', $id)->first();
        if ($kegiatan->nama_kegiatan == $nama_kegiatan && $kegiatan->kategori_kegiatan == $kategori_kegiatan && $kegiatan->kedudukan_kegiatan == $kedudukan_kegiatan && $kegiatan->point_kegiatan == $point_kegiatan && $kegiatan->tingkat_kegiatan == $tingkat_kegiatan && $kegiatan->subkategori_kegiatan == $subkategori_kegiatan && $kegiatan->tahun_kegiatan == $tahun_kegiatan) {
            // jika tidak ada yang berubah, redirect ke halaman kegiatan
            return redirect('/kegiatan')->with('message', 'Tidak ada data yang berubah');
        } else {
            if($kegiatan->subkategori_kegiatan == 'Lainnya'){
                KegiatanModel::where('id', $id)->update([
                    'point_kegiatan' => $point_kegiatan,
                ]);
            }else{
                // jika ada yang berubah, update data kegiatan
            KegiatanModel::where('id', $id)->update([
                'nama_kegiatan' => $nama_kegiatan,
                'kategori_kegiatan' => $kategori_kegiatan,
                'kedudukan_kegiatan' => $kedudukan_kegiatan,
                'subkategori_kegiatan' => $subkategori_kegiatan,
                'point_kegiatan' => $point_kegiatan,
                'tingkat_kegiatan' => $tingkat_kegiatan,
                'tahun_kegiatan' => $tahun_kegiatan
            ]);
            }                  
            // redirect ke halaman kegiatan
            return redirect('/kegiatan')->with('message', 'Kegiatan berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // ambil data dari request
        $id = $request->id;

        // hapus data kegiatan berdasarkan id
        KegiatanModel::where('id', $id)->delete();

        // redirect ke halaman kegiatan
        return redirect('/kegiatan')->with('message', 'Kegiatan berhasil dihapus');
    }
}
