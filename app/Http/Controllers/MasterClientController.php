<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MMasterClient;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class MasterClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function serverside()
    {
        $data = MMasterclient::where('status', 1)->get();
        // echo '<pre>';
        // var_dump($data);die;
        // echo '</pre>';
        // return DataTables::of(MMasterclient::get())->make(true);
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {
                // $button = "<button class='edit btn btn-danger' id='" .$data->id. "' > Ubah </button>";
                // $button .= "<button class='hapus btn btn-danger' id='" .$data->id. "' > Hapus </button>";
                $button = "
                        <div class='btn-group-vertical'>
                            <div class='btn-group'>
                            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                            </button>
                            <ul class='dropdown-menu' style=''>
                                <li><button class='edit dropdown-item' id='".$data->id."'>Edit</button></li>

                                <li><button class='hapus dropdown-item' id='".$data->id."'>Hapus</button></li>
                                
                            </ul>
                            </div>
                        </div>
                        ";

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function hapus(Request $request)
    {
        $update = MMasterClient::find($request->id)->update([
            'status' => '0',
         ]);
          if($update) :
            return response()->json(['status' => true, 'message' => 'Client berhasil di Hapus'], 200);
           else :
            return response()->json(['status' => false, 'message' => 'Client gagal di hapus'], 400);
           endif;
    }

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
