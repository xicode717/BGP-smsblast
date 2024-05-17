<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSMSBlast;
use App\Models\MMasterClient;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class SMSBlastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'list' => DB::table('tbl_sms_blast')
                    ->join('tbl_master_client', 'tbl_master_client.id', '=', 'tbl_sms_blast.id_client')
                    ->select('tbl_sms_blast.*', 'tbl_master_client.*')
                    ->get(),
        ];
        
        return view('admin.smsblast.index', $data);
    }


    public function sendsmsview()
    {
        $data = [
            'list' => MMasterClient::all(),
        ];
        return view('admin.smsblast.sendsms', $data);
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
        foreach($request->id as $item => $value){
            $get_client = MMasterClient::where('id', $request->id[$item])->get();
            foreach($get_client as $val){
                $data = array(
                    'id_client'     => $request->id[$item],
                    'phone'         => $val->phone,
                    'pesan'         => $request->pesan,
                    'tgl_kirim'     => date('Y-m-d'),
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $insert = MSMSBlast::create($data);
            }
        }

        Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');
         
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
        //
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
        //
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
