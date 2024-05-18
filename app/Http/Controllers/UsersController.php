<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user' => User::all(),
        ];
        return view('users.index', $data);
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
         $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'akses' => 'required',
         ], $message);

        if($validasi) :
         $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'akses' => $request->akses,
         );
         $input = User::create($data);
            if($input) :
                Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
        endif;
        return back();
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
            'edit' => User::find($id),
        ];

        return view('users.edit', $data);
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
            'name' => 'required',
            'email' => 'required',
            'akses' => 'required',
         ], $message);

         $data = User::find($id);
         if($request->password == ''){
            $password = $data['password'];
         }else{
            $password = Hash::make($request->password);
         }

        if($validasi) :            
            $update = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'akses' => $request->akses,
                'udpated_at' => date('Y-m-d H:i:s'),
             ]);
              if($update) :
                return redirect('users')->with('success', 'Data User berhasil di ubah');
               else :
                return back()->with('errors', 'Data User gagal  di ubah');
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
        //
    }
}
