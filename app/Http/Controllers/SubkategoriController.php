<?php

namespace App\Http\Controllers;

use App\Models\SubkategoriModel;
use Exception;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if the user is logged in admin
        // try{
            if (session('user')['role'] == 'Admin') {

                $subkategoris = SubkategoriModel::all();
                return view('home.subkategori', ['data' => $subkategoris, 'title' => 'Sub Kategori | Sistem Pendataan Keaktifan Mahasiswa']);
            }else{
                return redirect('/login')->with('message', 'Silahkan login terlebih dahulu');
            }

        // }catch(Exception $e){
        //     return redirect('/login')->with('message', 'Silahkan login terlebih dahulu');
        // }
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
        // dd($request->all());
        // check apakah ada sub kategori yang sama
        $nama_subkategori = $request->nama_subkategori;
        $subkategoris = SubkategoriModel::where('nama_subkategori', $request->nama_subkategori)->get();

        if (count($subkategoris) > 0) {
            return redirect('/kategori')->with('error', 'Data gagal ditambahkan');
        } else {
            SubkategoriModel::create([
                'nama_subkategori' => $request->nama_subkategori,
            ]);
            return redirect('/kategori')->with('message', 'Data berhasil ditambahkan');
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
    public function edit(Request $request)
    {
        // check nama sub kategori sama
        $id = $request->id;
         
        $subkategoris = SubkategoriModel::where('nama_subkategori', $request->nama_subkategori)->get();
        if (count($subkategoris) > 0) {
            return redirect('/kategori')->with('error', 'Data gagal dirubah');
        }else{
            SubkategoriModel::where('id', $id)->update([
                'nama_subkategori' => $request->nama_subkategori,
            ]);
            return redirect('/kategori')->with('message', 'Data berhasil dirubah');
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
        try{
            // get id from form
            $id = $request->id;
    
            // delete data from database
            SubkategoriModel::where('id', $id)->delete();
            
            return redirect('/kategori')->with('message', 'Data berhasil dihapus');

        }catch(Exception $e){
            return redirect('/kategori')->with('message', 'Data gagal dihapus');
        }
    }
}
