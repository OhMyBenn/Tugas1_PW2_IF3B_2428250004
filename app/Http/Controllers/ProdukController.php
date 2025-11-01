<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return response()->json($produk, 200);
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
            'nama'        => 'required|unique:produks',
            'kode'        => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            ]
        );

        $produk = Produk::create($validate); //Simpan data ke database
        if($produk){
            $data['success'] = true;
            $data['message'] = " Data produk berhasil disimpan";
            $data['data'] = $produk;
            return response()->json($produk, 201);
        } else {
            $data['success'] = false;
            $data['message'] = " Data produk gagal disimpan";
            return response()->json($data, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with('kategori')->find($id);
        if($produk){
            $data['success'] = true;
            $data['message'] = " Detail data produk";
            $data['data'] = $produk;
            return response()->json($data, 200);
        } else {
            $data['success'] = false;
            $data['message'] = " Data produk tidak ditemukan";
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate(
            [
            'nama'        => 'required|unique:produks,nama,'.$id,
            ]
        );

        $produk = Produk::find($id);
        if($produk){
            $produk->update($validate);
            $data['success'] = true;
            $data['message'] = " Data produk berhasil diupdate";
            $data['data'] = $produk;
            return response()->json($data, 200);
        } else {
            $data['success'] = false;
            $data['message'] = " Data produk tidak ditemukan";
            return response()->json($data, 404);
        }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $produk = Produk::find($id);

    if ($produk) {
        $produk->delete();
        return response()->json([
            'success' => true,
            'message' => "Data produk berhasil dihapus"
        ], Response::HTTP_OK);
    } else {
        return response()->json([
            'success' => false,
            'message' => "Data produk tidak ditemukan"
        ], Response::HTTP_NOT_FOUND);
    }
}

}