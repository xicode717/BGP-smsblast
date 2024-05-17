<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MMasterClient;
use RealRashid\SweetAlert\Facades\Alert;

class MasterClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'client' => MMasterClient::all(),
        ];
        
        return view('master.client.index', $data);
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
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];
         $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|min:11',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
         ], $message);

         $data = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
         );
         $input = MMasterClient::create($data);
         return redirect('master-client')->with('success', 'Master Client berhasil di tambah');
        //  if($input){
        //     return redirect('master-client')->with('success', 'Master Client berhasil di tambah');
        //  }else{
        //     return back()->with('errors', 'Master Client gagal  di tambah');
        //  }
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
        $data = [
            'edit' => MMasterClient::find($id),
        ];
        return view('master.client.edit', $data);
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
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];
         $validasi = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|min:11',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
         ], $message);

        if($validasi) :            
            $update = MMasterClient::find($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'status' => $request->status,
             ]);
              if($update) :
                return redirect('master-client')->with('success', 'Master Client berhasil di ubah');
               else :
                return back()->with('errors', 'Master Client gagal  di ubah');
               endif;
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(MMasterClient::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal di Hapus');
        endif;
      
      return back();
    }
}
