<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = \App\Pelanggan::All();
        return view('admin.pelanggan.pelanggan', ['pelanggan' => $pelanggan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pelanggan.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah_pelanggan = new \App\Pelanggan;
        $tambah_pelanggan->kd_pel = $request->addkd_pel;
        $tambah_pelanggan->nm_pel = $request->addnm_pel;
        $tambah_pelanggan->telepon = $request->addtelepon;
        $tambah_pelanggan->save();
        Alert::success('Pesan ', 'Data berhasil disimpan');
        return redirect('/pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan_edit = \App\Pelanggan::findOrFail($id);
        return view('admin.pelanggan.pelangganEdit', ['pelanggan' => $pelanggan_edit]);
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
        $pelanggan = \App\Pelanggan::findOrFail($id);
        $pelanggan->kd_pel = $request->get('addkd_pel');
        $pelanggan->nm_pel = $request->get('addnm_pel');
        $pelanggan->telepon = $request->get('telepon');
        $pelanggan->save();
        return redirect()->route('pelanggan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = \App\Pelanggan::findOrFail($id);
        $pelanggan->delete();
        Alert::success('Pesan ', 'Data berhasil dihapus');
        return redirect()->route('pelanggan.index');
    }
}
