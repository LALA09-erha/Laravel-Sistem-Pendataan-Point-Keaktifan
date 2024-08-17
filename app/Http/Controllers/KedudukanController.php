<?php

namespace App\Http\Controllers;

use App\Models\KedudukanModel;
use Illuminate\Http\Request;

class KedudukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('user')) {
            return redirect('/login');
        }
        // check if the user is logged in
        if (session('user')['role'] == 'Admin') {
            $kedudukan = KedudukanModel::all();

            return view('home.kedudukan', ['title' => 'Jenis Kedudukan | Sistem Pendataan Keaktifan Mahasiswa', 'kedudukans' => $kedudukan]);
        } else {
            return redirect('/login')->with('message', 'Silahkan login terlebih dahulu');
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
        // validate the data
        $request->validate([
            'nama_kedudukan' => 'required',
        ]);

        // search if the data already exists
        $kedudukan = KedudukanModel::where('nama_kedudukan', $request->nama_kedudukan)->first();
        if ($kedudukan) {
            return redirect('/kedudukan')->with('message', 'Jenis kedudukan sudah ada');
        } else {
            KedudukanModel::create([
                'nama_kedudukan' => $request->nama_kedudukan,
            ]);
            return redirect('/kedudukan')->with('message', 'Jenis kedudukan berhasil ditambahkan');
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
        // ambil data dari form
        $nama_kedudukan = $request->nama_kedudukan;

        // search if the data already exists
        $kedudukan = KedudukanModel::where('nama_kedudukan', $nama_kedudukan)->first();

        // check if the data already exists
        if ($kedudukan) {
            return redirect('/kedudukan')->with('message', 'Jenis kedudukan sudah ada');
        } else {
            KedudukanModel::where('id', $request->id)->update([
                'nama_kedudukan' => $request->nama_kedudukan,
            ]);
            return redirect('/kedudukan')->with('message', 'Jenis kedudukan berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // get id from form
        $id = $request->id;

        // delete data from database
        KedudukanModel::where('id', $id)->delete();

        return redirect('/kedudukan')->with('message', 'Jenis kedudukan berhasil dihapus');
    }
}
