<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Validator;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Cabang::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Cabang',
            'data' => $cabang
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'nama_cab' => 'required',
                'alamat_cab' => 'required',
            ],
            [
                'nama_cab.required' => 'Masukan Nama Cabang !',
                'alamat_cab.required' => 'Masukan Alamat Cabang !',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $cabang = Cabang::create([
                'nama_cab' => $request->input('nama_cab'),
                'alamat_cab' => $request->input('alamat_cab'),
            ]);

            if($cabang){
                return response()->json([
                    'success' => true,
                    'message' => 'Cabang Berhasil Disimpan',
                ], 200);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cabang gagal disimpan',
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cabang = Cabang::where('kd_cab', $id)->get();

        if ($cabang) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Cabang!',
                'data'    => $cabang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cabang Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_cab' => 'required',
                'alamat_cab' => 'required',
            ],
            [
                'nama_cab.required' => 'Masukan Nama Cabang !',
                'alamat_cab.required' => 'Masukan Alamat Cabang !'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $cabang = Cabang::where('kd_cab',$request->input('id'))->update([
                'nama_cab' => $request->input('nama_cab'),
                'alamat_cab' => $request->input('alamat_cab'),
            ]);

            if($cabang){
                return response()->json([
                    'success' => true,
                    'message' => 'Cabang Berhasil Disimpan',
                ], 200);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cabang gagal disimpan',
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();

        if($cabang){
            return response()->json([
                'success' => true,
                'message' => 'Cabang berhasil Dihapus!',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Cabang Gagal Dihapus!',
            ], 500);
        }
    }
}
