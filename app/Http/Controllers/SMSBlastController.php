<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSMSBlast;
use App\Models\MMasterClient;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class SMSBlastController extends Controller
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
                    'created_at'    => date('Y-m-d H:i:s'),
                    'udpated_at'    => null
                );
                $this->sendwa($val->phone, $request->pesan);
                $insert = MSMSBlast::create($data);
            }
        }

        Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');
         
         return back();
    }

    public function resend($id)
    {
        if(empty($id))
        {
            Alert::error('Gagal!', 'Tidak ada data');
        }
        else{
            $data = MSMSBlast::find($id);
            $create = MSMSBlast::create([
                'id_client'     => $data['id_client'],
                'phone'         => $data['phone'],
                'pesan'         => $data['pesan'],
                'tgl_kirim'     => date('Y-m-d'),
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'udpated_at'    => null
            ]);
            $this->sendwa($data['phone'], $data['pesan']);
            if($create)
            {
                Alert::success('Berhasil!', 'Pesan berhasil di resend');
            }else{
                Alert::error('Gagal', 'Pesan sedang dalam kendala');
            }
        }
        
    }

    public function serverside()
    {
        $query = DB::table('tbl_sms_blast')
                ->join('tbl_master_client', 'tbl_master_client.id', '=', 'tbl_sms_blast.id_client')
                ->select('tbl_sms_blast.*', 'tbl_master_client.*')
                ->get();
        // $data = DataTables::of($query)->make(true);
        // echo '<pre>';
        // var_dump($data);die;
        // echo '</pre>';
        return DataTables::of($query)->make(true);
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

    public function sendwa($phone, $pesan)
    {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
            'target' => $phone,
            'message' => $pesan, 
            'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: zXGH2mayNLbaDhwYuWM7' //change TOKEN to your actual token
            ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            }
            curl_close($curl);

            // if (isset($error_msg)) {
            // echo $error_msg;
            // }
            // echo $response;
    }
}
