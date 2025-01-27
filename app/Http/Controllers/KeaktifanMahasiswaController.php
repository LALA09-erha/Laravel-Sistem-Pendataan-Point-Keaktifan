<?php

namespace App\Http\Controllers;

use App\Models\KeaktifanMahasiswaModel;
use App\Models\KegiatanModel;
use App\Models\MahasiswaModel;
use App\Models\ProfilTtdModel;
use App\Models\SubkategoriModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
use Dompdf\Options;
use LengthException;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\String_;

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

                if(session('user')['role'] == 'Dosen'){
                    $mahasiswas = MahasiswaModel::where('nip_dosen', session('user')['nip'])->get();
                }else{
                    $mahasiswas = MahasiswaModel::all();
                }
                // ambil model mahasiswa dari database yang nip_dosen sesuai session(user)['nip']
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
                // dd(session('user')['nip']);   
                
                if(session('user')['role'] == 'Dosen'){
                
                $nip = session('user')['nip'];

                // ambil model keaktifan mahasiswa dari database dengan status menunggu dengan data yang unique nim
                $keaktifans = KeaktifanMahasiswaModel::join('mahasiswa_models', 'keaktifan_mahasiswa_models.nim', '=', 'mahasiswa_models.nim') // Join on nim
                ->where('mahasiswa_models.nip_dosen', $nip) // Filter by nip_dosen
                ->where('keaktifan_mahasiswa_models.status', 'Menunggu') // Filter by status
                ->select('keaktifan_mahasiswa_models.*', 'mahasiswa_models.nim') // Select relevant columns
                ->get();
                }else{
                    $keaktifans = KeaktifanMahasiswaModel::where('status', 'Menunggu')->get();
                }

                $keaktifans = $keaktifans->unique('nim');

                // dd($keaktifans);
                
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
            if (session('user')['role'] == 'Dosen' || session('user')['role'] == 'Admin') {
                return redirect('login');
            } else {
                $data = session('user');
                $kegiatan = KegiatanModel::all();

                $subkategori_kegiatan = SubkategoriModel::all();

                // inisialisasi objek Options  berdasarkan subkategori
                $temp_kegiatan = (object) [];
                $temp_kedudukan = (object) [];
                $temp_tingkatan = (object) [];
                foreach ($subkategori_kegiatan as $sub) {
                    $temp1 = [];
                    $temp2 = [];
                    $temp3 = [];
                    foreach ($kegiatan as $keg) {
                        if ($sub->nama_subkategori == $keg->subkategori_kegiatan) {
                            // masukkan data ke temp
                            // sebelum dipush check apakah ada data di array
                            if(!in_array($keg->nama_kegiatan, $temp1)){
                                array_push($temp1, $keg->nama_kegiatan);       
                            }


                            if(!in_array($keg->kedudukan_kegiatan, $temp2)){
                                array_push($temp2, $keg->kedudukan_kegiatan);                                
                            }


                            if(!in_array($keg->tingkat_kegiatan, $temp3)){
                                array_push($temp3, $keg->tingkat_kegiatan);
                            }

                        }
                    }
                    $temp_kegiatan->{$sub->nama_subkategori} = $temp1;
                    $temp_kedudukan->{$sub->nama_subkategori} = $temp2;
                    $temp_tingkatan->{$sub->nama_subkategori} = $temp3;
                }

                // dd(gettype($temp_kedudukan));

                // dd($temp_kegiatan , $temp_kedudukan, $temp_tingkatan);
                
                return view('home.uploaddatakeaktifan', ['title' => 'Upload Data Keaktifan  | Sistem Pendataan Keaktifan Mahasiswa', 'data' => $data, 'temp_kegiatan' => $temp_kegiatan, 'temp_kedudukan' => $temp_kedudukan, 'temp_tingkatan' => $temp_tingkatan , 'subkategori_kegiatan' => $subkategori_kegiatan]);
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
        
        $sub_kategori = $request->sub_kategori;

        $sub_kategori_temp = str_replace(' ', '_', $sub_kategori);

        $kegiatan_temp = $request['kegiatan_' . $sub_kategori_temp];

        $kedudukan_temp = $request['kedudukan_' . $sub_kategori_temp];

        $tingkat_temp = $request['tingkatan_' . $sub_kategori_temp]; 
        
        $sub_kegiatan = null;
        
        if($kegiatan_temp == "null" || $kedudukan_temp == "null" || $tingkat_temp == "null"){
            return redirect('/uploaddatakeaktifan')->with('message', 'Semua kolom harus diisi');
        }else if(strpos(strtolower($kegiatan_temp), 'lainnya') !== false ){
            if($request->sub_kegiatan == null){
                return redirect('/uploaddatakeaktifan')->with('message', 'Sub Kegiatan harus diisi');
            }
            $sub_kegiatan = $request->sub_kegiatan;
        }


        try {

            
                // ambil data kegiatan berdasarkan id kegiatan
            $data_kegiatan = KegiatanModel::where('nama_kegiatan', $kegiatan_temp)->where('subkategori_kegiatan', $sub_kategori)->where('kedudukan_kegiatan', $kedudukan_temp)->where('tingkat_kegiatan', $tingkat_temp)->get();
            

            // nama mahasiswa
            $nama_mahasiswa = $request->nama;

            // nim
            $nim = $request->nim;

            // tanggal kegiatan
            $tanggal = $request->tanggal;

            if($tanggal > date('Y-m-d')){
                return redirect('/uploaddatakeaktifan')->with('error', 'Tidak dapat menginput kegiatan yang sebelumnya');
            } 

            // point kegiatan
            $point_kegiatan = $data_kegiatan[0]->point_kegiatan;

            // nama kegiatan
            if($sub_kegiatan != null){
                $nama_kegiatan = $data_kegiatan[0]->nama_kegiatan . " - " . $sub_kegiatan;
            }else{
                $nama_kegiatan = $data_kegiatan[0]->nama_kegiatan ;
            }
            

            // kategori kegiatan
            $kategori_kegiatan = $data_kegiatan[0]->kategori_kegiatan;

            // subkategori kegiatan
            $subkategori_kegiatan = $data_kegiatan[0]->subkategori_kegiatan;

            //kedudukan kegiatan
            $kedudukan_kegiatan = $data_kegiatan[0]->kedudukan_kegiatan;

            // tingkat kegiatan
            $tingkat_kegiatan = $data_kegiatan[0]->tingkat_kegiatan;
                  
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
                'tanggal_kegiatan' => $tanggal,
                'data_kegiatan' => $nama_kegiatan,
                'kedudukan_kegiatan' => $kedudukan_kegiatan,
                'tingkat_kegiatan' => $tingkat_kegiatan,
                'kategori_kegiatan' => $kategori_kegiatan,
                'subkategori_kegiatan' => $subkategori_kegiatan,
                'file_kegiatan' => $nama_file,
                'point_kegiatan' => $point_kegiatan,
                'status' => 'Menunggu'
            ];
            // masukkan data keaktifan mahasiswa ke database
            KeaktifanMahasiswaModel::create($data);

            /// jika berhasil maka kembalikan ke halaman /transkippointkeaktifan

            return redirect('/transkippointkeaktifan')->with('message', 'Data berhasil diupload');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal diupload, Silahkan coba lagi');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] == 'Mahasiswa') {
                return redirect('login');
            }else {
                // ambil semua data keaktifan mahasiswa berdasarkan nim  mahasiswa
                $mahasiswa = KeaktifanMahasiswaModel::where('nim', $id)->get();
                $data = MahasiswaModel::find($id);
                return view('home.detailkeaktifanmahasiswa', ['mahasiswa' => $mahasiswa, 'title' => 'Detail Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa', 'data' => $data]);
            }
        }
    }
    public function acc_validasi(string $id)
    {
        if (session('user') == null) {
            return redirect('login')->with('message', 'Silahkan login terlebih dahulu');
        } else {
            if (session('user')['role'] == 'Mahasiswa') {
                return redirect('login');
            }else {
            // ambil semua data keaktifan mahasiswa berdasarkan nim  mahasiswa dan data yang belum di validasi
                $mahasiswa = KeaktifanMahasiswaModel::where('nim', $id)->where('status', 'Menunggu')->get();
                $data = MahasiswaModel::find($id);
                return view('home.acckeaktifanmahasiswa', ['mahasiswa' => $mahasiswa, 'title' => 'Validasi Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa', 'data' => $data]);
            }
        }
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
            if (session('user')['role'] != 'Mahasiswa') {
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
        // sebelum data siap
        //    tampilkan web tulisan "Tunggu sebentar, Halaman sedang dalam proses dan akan dialihkan otomatis"
        



        $nim = $request->nim;
        $data = MahasiswaModel::where('nim', $nim)->get()[0];
        $mahasiswa = KeaktifanMahasiswaModel::where('nim', $nim)->where('status', 'Disetujui')->get();

        // mengambil nip_dosen dari data mahasiswa dan mencari data dosen berdasarkan nip
        $dosen = UsersModel::where('nip', $data->nip_dosen)->get()[0];
        // dd($dosen);

        // buatkan data yang unik di sub kategori keaktifan mahasiswa dan kategori pilihan
        $data_unik = [];
        
        
        foreach ($mahasiswa as $key => $value) {
            if(!in_array($value->subkategori_kegiatan, $data_unik)&& $value->kategori_kegiatan == "Pilihan") {
                $data_unik[] = $value->subkategori_kegiatan;
            }
        }

      
        $fix ='';
        foreach ($data_unik as $keyy => $valuee) {
            $fix .= '<tr>
            <td colspan="5" class="center-text">
            <strong>'.strtoupper($valuee).'</strong>
            </td>
            </tr>';
            $index =1;
            foreach ($mahasiswa as $key => $value) {
                if ($valuee == $value->subkategori_kegiatan && $value->kategori_kegiatan == "Pilihan") {
                    $fix .= '<tr>
                    
                    <td>'.
                    $index.
                    '</td>
                    <td>'.
                    $value->data_kegiatan
                    .'</td>
                    <td>'
                    .$value->kedudukan_kegiatan
                    .'</td>
                    <td>'
                    .$value->tingkat_kegiatan.'</td>
                    <td>'.$value->point_kegiatan.'</td>
                    </tr>';                 
                    
                    $index++;
                }               
                
            }                
        }
        // dd($fix);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Satuan Kredit Prestasi Mahasiswa</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid black;
                }
                th, td {
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .no-border {
                    border: none;
                }
                .header {
                    text-align: center;
                    font-weight: bold;
                    margin-bottom: 20px;
                }
                .center-text {
                    text-align: center;
                }
                .footer {
                    margin-top: 30px;
                    text-align: right;
                    font-weight: bold;
                }
                
            </style>
        </head>
        <body>
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f1/UTM_DIKBUDRISTEK.png" alt="Logo UTM" width="100px" style="display: block; margin: 0 auto; align-content: center; margin-bottom: 20px; justify-content: center; ">
            <br>Universitas Trunojoyo Madura <br>
            Satuan Kredit Prestasi Mahasiswa Trunojoyo Madura
        </div>

        <div>Nama &emsp; &emsp; &emsp; &emsp; &nbsp;: ' . $data->name . '</div>
        <div>NIM &emsp; &emsp; &emsp; &emsp; &emsp; : ' . $data->nim . '</div>
        <div>Program Studi &emsp; : ' . $data->prodi . '</div>
        <div>Fakultas &emsp; &emsp; &emsp;  &nbsp;: Teknik</div>

        <br>

        <table>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Kedudukan</th>
                <th>Tingkatan</th>
                <th>Poin</th>
            </tr>
            <tr>
                <td colspan="5" class="center-text"><strong>KEGIATAN WAJIB</strong></td>
            </tr>
            <tr>
                <td colspan="5" class="center-text"><strong>PENGENALAN KEHIDUPAN KAMPUS</strong></td>
            </tr>
            '. 
            $mahasiswa->map(function ($item, $key) {
                if($item->kategori_kegiatan == 'Wajib'){
                    return '
                    <tr>
                        <td>'. ($key) .'</td>
                        <td>'.$item->data_kegiatan.'</td>
                        <td>'.$item->kedudukan_kegiatan.'</td>
                        <td>'.$item->tingkat_kegiatan.'</td>
                        <td>'.$item->point_kegiatan.'</td>
                    </tr>
                    ';                    
                }
            })->implode('')
            .'
           
            <tr>
                <td colspan="5" class="center-text"><strong>KEGIATAN PILIHAN</strong></td>
            </tr>
            '.
            $fix 
            .'            
            <tr>
                <td colspan="4" class="center-text"><strong>Total Poin</strong></td>
                <td>'. $data->total_point . '</td>
            </tr>
        </table>

        <div class="footer">
            Bangkalan, ' . date('d F Y') . '<br>
            Dosen Wali
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            '. $dosen->name .' <br>
            NIP: '. $dosen->nip . '
        </div>

        </body>
        </html>
        ';
        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->WriteHTML($html);
        // $mpdf->Output();

        //download file
        $namefile =  $nim.now().'.pdf';
        $mpdf->Output($namefile, 'D');
 
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

    public function datadosen(Request $request)
    {   
        try{
            // jika bukan Admin
            if(session('user')['role'] == 'Admin'){
                $data = UsersModel::all();
                return view('home.datadosen', [
                    'data' => $data , 'title' => 'Data Dosen | Sistem Pendataan Keaktifan Mahasiswa'
                ]);
            }else{
                return redirect('/');
            }

        }catch(\Throwable $th){
            // to /
            return redirect('/');
        }
    }

    public function add_dosen(Request $request ){

        try{
            // cek apakah dosen sudah ada berdaasarkan NIP
            $data = MahasiswaModel::where('nim', $request->nip)->get();            
            if(count($data) > 0){
                return redirect('/data-dosen')->with('error', 'Data Dosen Gagal Ditambahkan!');
            }else{
                UsersModel::create([
                    'role' => $request->role,
                    'nip' => $request->nip,
                    'name' => $request->nama,
                    'email' => strval($request->nip) . '@trunojoyo.ac.id',                    
                    'password' => Hash::make($request->nip),
                ]);
                return redirect('/data-dosen')->with('message', 'Data Dosen Berhasil Ditambahkan');                
            }
        }catch(\Throwable $th){
            return redirect('/data-dosen')->with('error', 'Data Dosen Gagal Ditambahkan');
        }
        
    }

    public function delete_dosen(Request $request ){
        try{
            UsersModel::where('nip', $request->id)->delete();
            return redirect('/data-dosen')->with('message', 'Data Dosen Berhasil DiHapus');
        }catch(\Throwable $th){
            return redirect('/data-dosen')->with('error', 'Data Dosen Gagal' . $th);
        }
    }

    public function editdosen(Request $request )
    {
        $data = UsersModel::where('nip', $request->nip)->get();

        // check with database
        if($request->nip == $data[0]->nip && $request->nama == $data[0]->name && $request->role == $data[0]->role){
            return redirect('/data-dosen')->with('error', 'Data Dosen Tidak Berubah');
        }else{
            UsersModel::where('nip', $request->nip)->update([
                'name' => $request->nama,
                'role' => $request->role,
                'nip' => $request->nip
            ]);
            return redirect('/data-dosen')->with('message', 'Data Dosen Berhasil Berubah');
        }

    }
}
