<?php

namespace App\Http\Controllers;

use App\Models\KeaktifanMahasiswaModel;
use App\Models\KegiatanModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;


class KeaktifanMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] == 'Mahasiswa') {
                return redirect('login');
            } else {
                // ambil model mahasiswa dari database
                $mahasiswas = MahasiswaModel::all();
                return view('home.keaktifanmahasiswa', ['mahasiswas' => $mahasiswas, 'title' => 'Data Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa']);
            }
        }
    }

    // view validasi keaktifan mahasiswa
    public function validasi()
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] == 'Mahasiswa') {
                return redirect('login');
            } else {
                // ambil model keaktifan mahasiswa dari database dengan status menunggu
                $keaktifans = KeaktifanMahasiswaModel::where('status', 'Menunggu')->get();
                return view('home.validasikeaktifanmahasiswa', ['title' => 'Validasi Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa', 'keaktifans' => $keaktifans]);
            }
        }
    }


    // view uploaddatakeaktifan
    public function upload()
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] == 'Dosen') {
                return redirect('login');
            } else {
                $data = session('user');
                $kegiatan = KegiatanModel::all();
                return view('home.uploaddatakeaktifan', ['title' => 'Upload Data Keaktifan  | Sistem Pendataan Keaktifan Mahasiswa', 'data' => $data, 'kegiatan' => $kegiatan]);
            }
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
        try {

            // ambil data kegiatan berdasarkan id kegiatan
            $data_kegiatan = KegiatanModel::where('id', $request->kegiatan)->get();

            // nama mahasiswa
            $nama_mahasiswa = $request->nama;

            // nim
            $nim = $request->nim;

            // semester
            $semester = $request->semester;

            // point kegiatan
            $point_kegiatan = $data_kegiatan[0]->point_kegiatan;

            // nama kegiatan
            $nama_kegiatan = $data_kegiatan[0]->nama_kegiatan . " | " . $data_kegiatan[0]->kedudukan_kegiatan . " | " . $data_kegiatan[0]->tingkat_kegiatan;

            // nama file
            $nama_file = $nim . "." . date('Y.m.d.H.i.s') . "." . $request->file('file')->extension();

            // dd($nama_file);

            // menyimpan file ke folder public dengan nama file yang sudah diatur sebelumnya
            $file = $request->file('file');
            $file->storeAs('public/filekeaktifanmahasiswa', $nama_file);

            // mengambil data point
            $point_kegiatan = $data_kegiatan[0]->point_kegiatan;

            // data yang akan diinputkan ke database
            $data = [
                'nama_mahasiswa' => $nama_mahasiswa,
                'nim' => $nim,
                'semester' => $semester,
                'data_kegiatan' => $nama_kegiatan,
                'file_kegiatan' => $nama_file,
                'point_kegiatan' => $point_kegiatan,
                'status' => 'Menunggu'
            ];

            // masukkan data keaktifan mahasiswa ke database
            KeaktifanMahasiswaModel::create($data);

            /// jika berhasil maka kembalikan ke halaman /transkippointkeaktifan

            return redirect('/transkippointkeaktifan')->with('message', 'Data berhasil diupload');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal diupload');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ambil semua data keaktifan mahasiswa berdasarkan nim  mahasiswa
        $mahasiswa = KeaktifanMahasiswaModel::where('nim', $id)->get();
        $data = MahasiswaModel::find($id);
        return view('home.detailkeaktifanmahasiswa', ['mahasiswa' => $mahasiswa, 'title' => 'Detail Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa', 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $status = $request->status;
        $id = $request->id;
        $nim = $request->nim;


        $keaktifan = KeaktifanMahasiswaModel::where('id', $id)->get();

        $data_mahas = MahasiswaModel::where('nim', $nim)->get();

        // jika status tidak sama dengan yang ada di database

        if ($status != $keaktifan[0]->status) {
            try {
                // ada tiga status yang bisa diubah yaitu Disetujui, Ditolak, dan Menunggu
                // Jika status awalnya menunggu menjadi disetujui maka point akan ditambahkan ke mahasiswa
                // Jika status awalnya menunggu menjadi ditolak maka point tidak akan ditambahkan ke mahasiswa
                // Jika status awalnya disetujui menjadi ditolak maka point akan dikurangkan dari mahasiswa
                // Jika status awalnya disetujui menjadi menunggu maka point akan dikurangkan dari mahasiswa
                // Jika status awalnya ditolak menjadi disetujui maka point akan ditambahkan ke mahasiswa
                // Jika status awalnya ditolak menjadi menunggu maka point tidak akan ditambahkan ke mahasiswa

                if ($status == 'Disetujui') {
                    $point = $data_mahas[0]->total_point + $keaktifan[0]->point_kegiatan;
                    // dd($point);
                    MahasiswaModel::where('nim', $nim)->update(['total_point' => $point]);
                } else if ($status == 'Ditolak') {
                    if ($keaktifan[0]->status == 'Menunggu') {
                        $point = $data_mahas[0]->total_point;
                        MahasiswaModel::where('nim', $nim)->update(['total_point' => $point]);
                    } else {
                        $point = $data_mahas[0]->total_point - $keaktifan[0]->point_kegiatan;
                        MahasiswaModel::where('nim', $nim)->update(['total_point' => $point]);
                    }
                } else {
                    if ($keaktifan[0]->status == 'Disetujui') {
                        $point = $data_mahas[0]->total_point - $keaktifan[0]->point_kegiatan;
                        // dd($point);
                        MahasiswaModel::where('nim', $nim)->update(['total_point' => $point]);
                    }
                }



                KeaktifanMahasiswaModel::where('id', $id)->update(['status' => $status]);
                return redirect()->back()->with('message', 'Status berhasil diubah');
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Status tidak berubah');
            }
        } else {
            return redirect()->back()->with('message', 'Status tidak berubah');
        }
    }

    // melihat  transkip point keaktifan mahasiswatranskippoint
    public function transkippoint()
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] != 'Admin' && session('user')['role'] != 'Mahasiswa') {
                return redirect('login');
            } else {
                // ambil semua data mahasiswa di keaktifan mahasiswa model berdasarkan nim/nip yang disetujui

                if (session('user')['role'] == 'Mahasiswa') {
                    $nim = session('user')['nim'];
                } else {
                    $nim = session('user')['nip'];
                }
                $mahasiswa = KeaktifanMahasiswaModel::where('nim', $nim)->get();

                return view('home.transkippointkeaktifan', ['mahasiswa' => $mahasiswa, 'title' => 'Transkip Point Keaktifan  | Sistem Pendataan Keaktifan Mahasiswa', 'nim' => $nim]);
            }
        }
    }


    // download data keaktifan mahasiswa yang sudah disetujui oleh admin menjadi file pdf
    public function download(Request $request)
    {
        $nim = $request->nim;
        $data = MahasiswaModel::where('nim', $nim)->get()[0];

        $mahasiswa = KeaktifanMahasiswaModel::where('nim', $nim)->where('status', 'Disetujui')->get();



        $pdf = PDF::loadview('pdf.tamplate', ['mahasiswa' => $mahasiswa, 'data' => $data])->setPaper('a4', 'landscape')->setWarnings(true)->setOptions(['isPhpEnabled' => true]);


        return $pdf->download($nim . "." . date('h.m.s') . '.pdf');

        // return view('pdf.tamplate', ['mahasiswa' => $mahasiswa, 'data' => $data]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function showfile(string $file)
    {
        try {
            // ambil file dari folder public/filekeaktifanmahasiswa
            return Storage::response('public/filekeaktifanmahasiswa/' . $file,);
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'File tidak ditemukan');
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
    public function destroy(string $id)
    {
        //
    }
}
