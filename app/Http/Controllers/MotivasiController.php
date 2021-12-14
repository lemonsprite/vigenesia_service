<?php

namespace App\Http\Controllers;

use App\Http\Resources\MotivasiResource;
use App\Models\Motivasi;
use Illuminate\Http\Request;

class MotivasiController extends Controller
{
    
    public function index()
    {
        // Get Motivasi ditambah relasi ke tabel user
        $motivasi = Motivasi::with(['hasUser']);

        // Return data ke Resource Classes
        return MotivasiResource::collection($motivasi->get())->response();
    }

    public function store(Request $req)
    {
        // Validasi parameter request
        $param = $req->validate([
            'isi_motivasi' => 'required|string',
            'id_user' => 'required|integer'
        ]);

        // Insert data ke database
        $res = Motivasi::create([
            'isi_motivasi' => $param['isi_motivasi'],
            'id_user' => $param['id_user']
        ]);

        // Return Respon API
        return response([
            'message' => 'Data berhasil dibuat.',
            'data' => $res
        ], 201);
    }

    public function show($id)
    {
        // Ambil data dengan relasi ke tabel user
        $res = Motivasi::with('hasUser')->where('id', $id)->get();

        // Return respon API
        return MotivasiResource::collection($res);
    }

    public function update(Request $req, $id)
    {

        // Validasi parameter request
        $req->validate([
            'isi_motivasi' => 'required|string'
        ]);

        // Ambil data jika ada, apabila tidak ada throw exception
        $res = Motivasi::find($id);

        // Update database dari parameter request
        $res->update($req->all());

        // Return respon API
        return response([
            'message' => 'Data berhasil diupdate.',
            'data' => $res
        ], 202);

    }

    public function destroy($id)
    {
        // Hapus data berdasarkan ID
        $res = Motivasi::destroy($id);

        // Return respon API
        return response([
            'message' => 'Data berhasil dihapus.',
            'data' => $res
        ],202);
    }
}
