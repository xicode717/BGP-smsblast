<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMasterClient extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tbl_master_client';
    protected $fillable = [
        'nama','phone','email','alamat','tgl_lahir','gender','status','created_at','updated_at'
  ];
}
