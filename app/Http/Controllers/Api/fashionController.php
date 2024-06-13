<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\fashion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class fashionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = fashion::orderBy('nama','asc')-> get();
        return response()->json([
            'status' => true,
            'massage' => 'data ditemukan',
            'data'=>$data
        ],200);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datafashion = new fashion;

        $rules = [
            'nama' => 'required',
            'nomortelp' => 'required',
            'alamat' => 'required',
            'gambar' => 'required',
            'text' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'massage' => 'data gagal ditambahkan',
                'data' => $validator->errors()
            ]);
        }



        $datafashion-> nama = $request->nama;
        $datafashion-> nomortelp = $request->nomortelp;
        $datafashion-> alamat = $request->alamat;
        $datafashion-> gambar = $request->gambar;
        $datafashion-> text = $request->text;

        $post = $datafashion->save();

        return response()->json([
            'status' => true,
            'massage' => 'data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = fashion::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'massage' => 'data ditemukan',
                'data'=>$data
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'massage' => 'data tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datafashion = fashion::find($id);
        if(empty($datafashion)){
            return response()->json([
                'status' => false,
                'massage' => 'data tidak ditemukan'
            ],404);
        }

        $rules = [
            'nama' => 'required',
            'nomortelp' => 'required',
            'alamat' => 'required',
            'gambar' => 'required',
            'text' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'massage' => 'gagal melakukan update data',
                'data' => $validator->errors()
            ]);
        }



        $datafashion-> nama = $request->nama;
        $datafashion-> nomortelp = $request->nomortelp;
        $datafashion-> alamat = $request->alamat;
        $datafashion-> gambar = $request->gambar;
        $datafashion-> text = $request->text;

        $post = $datafashion->save();

        return response()->json([
            'status' => true,
            'massage' => 'sukses berhasil update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $fashion = Fashion::findOrFail($id);
    $fashion->delete();

    return response()->json(['success' => 'Item deleted successfully!']);
}
}
