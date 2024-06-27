<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MUserDevices;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class UserDeviceController extends Controller
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
        return view('master.devices.index');
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
            'name' => 'required',
            'token' => 'required',
            'phone' => 'required|numeric|min:11'
         ], $message);

         $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'token' => $request->token
         );
         $input = MUserDevices::create($data);
        //  return redirect('userdevices')->with('success', 'Master Client berhasil di tambah');
         if($input){
            return redirect('userdevices')->with('success', 'Master Devices berhasil di tambah');
         }else{
            return back()->with('errors', 'Master Client gagal  di tambah');
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
            'edit' => MUserDevices::find($id),
        ];
        return view('master.devices.edit', $data);
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
            'token' => 'required',
            'phone' => 'required|numeric|min:11',
         ], $message);

        if($validasi) :            
            $update = MUserDevices::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'token' => $request->token,
                'status' => $request->status,
             ]);
              if($update) :
                return redirect('userdevices')->with('success', 'Devices berhasil di ubah');
               else :
                return back()->with('errors', 'Devices gagal  di ubah');
               endif;
        endif;
    }

    public function serverside()
    {
        $data = MUserDevices::where('status', 1)->get();
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
    public function hapus(Request $request)
    {
        return response()->json($request);die;
        $update = MUserDevices::find($request->id)->update([
            'status' => '0',
         ]);
          if($update) :
            return response()->json(['status' => true, 'message' => 'User Devices berhasil di Hapus'], 200);
           else :
            return response()->json(['status' => false, 'message' => 'User Devices gagal di hapus'], 400);
           endif;
    }
    public function destroy($id)
    {
        //
    }
}
