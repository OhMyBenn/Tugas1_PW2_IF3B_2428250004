<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori, 200);
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
        $validate = $request->validate(
            [
            'nama' => 'required|unique:kategoris,nama',
            'kode' => 'required',
            ]
        );

        $kategori = Kategori::create($validate); //Simpan data ke database
        if($kategori){
            $data['success'] = true;
            $data['message'] = " Data kategori berhasil disimpan";
            $data['data'] = $kategori;
            return response()->json($kategori, 201);
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::with('produks')->find($id);

    if ($kategori) {
        $data['success'] = true;
        $data['message'] = " Detail data kategori";
        $data['data'] = $kategori;
        return response()->json($data, 200);
    } else {
        return response()->json([
            'message' => 'Kategori tidak ditemukan'
        ], 404);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $harga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $id)
    {
        //Cari data Kategori berdasarkan ID
        $kategori = Kategori::find($id->id);
        if($kategori){
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'kode' => 'required',
                ]
        );
        //Update data Kategori
        Kategori::where('id', $id)->update($validate);
        //Mengambil data Kategori yang telah diupdate
        $kategori = Kategori::find($id);
        if ($kategori) {
            $data['success'] = true;
            $data['message'] = "Data kategori berhasil diupdate";
            $data['data'] = $kategori;
            return response()->json($data, 201);
        } else {
            $data['success'] = false;
            $data['message'] = "Data kategori gagal diupdate";
            return response()->json($data, 500);
        }
        }
    }   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if($kategori){
            $kategori->delete();
            $data['success'] = true;
            $data['message'] = "Data kategori berhasil dihapus";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['message'] = "Data kategori gagal dihapus";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
