<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = \App\Menu::All();
        return view('admin.menu.menu',['menu' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $tambah_menu = new \App\Menu;
            $tambah_menu->kd_mnu = $request->addkdmnu;
            $tambah_menu->nm_mnu = $request->addnmmnu;
            $tambah_menu->harga = $request->addharga;
            $tambah_menu->save();
        Alert::success('Pesan ', 'Data berhasil disimpan');
        return redirect('/menu');
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
        $menu_edit = \App\Menu::findOrFail($id);
        return view('admin.menu.menuEdit', ['menu' => $menu_edit]);
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
        $menu = \App\Menu::findOrFail($id);
        $menu->kd_mnu = $request->get('addkdmnu');
        $menu->nm_mnu = $request->get('addnmmnu');
        $menu->harga = $request->get('addharga');
        $menu->save();
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = \App\Menu::findOrFail($id);
        $menu->delete();
        Alert::success('Pesan ', 'Data berhasil dihapus');
        return redirect()->route('menu.index');
    }
}
