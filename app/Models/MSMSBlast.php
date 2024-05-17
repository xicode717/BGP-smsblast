<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSMSBlast extends Model
{
    use HasFactory;
    protected $table = 'tbl_sms_blast';
    protected $fillable = [
        'id_client','phone','pesan','status','tgl_kirim','created_at','updated_at'
  ];
}
