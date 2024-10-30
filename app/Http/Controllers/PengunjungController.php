<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengunjung = Pengunjung::all();
        if ($pengunjung->isEmpty()) {
            $response['message'] = 'tidak ada data pengunjung';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = "Pengunjung ditemukan";
        $response['data'] = $pengunjung;
        return response()->json($response, Response::HTTP_OK);
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
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        $pengunjung = Pengunjung::create($validate);
        if ($pengunjung) {
            $response['success'] = true;
            $response['message'] = 'Pengunjung berhasil ditambahkan';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($pengunjung)
    {
        $pengunjung = Pengunjung::find($pengunjung);
        $data['success'] = true;
        $data['message'] = 'detail data pengunjung';
        $data['data'] = $pengunjung;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengunjung $pengunjung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        Pengunjung::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'Pengunjung berhasil diperbarui';
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengunjung = Pengunjung::where('id', $id);

        if (count($pengunjung->get())) {
            $pengunjung->delete();
            $response['success'] = true;
            $response['message'] = 'Pengunjung berhasil dihapus';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Pengunjung tidak ditemukan';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}
