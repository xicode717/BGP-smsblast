<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMasterCleint extends Model
{
    use HasFactory;
    protected $table = 'tbl_master_cleint';
    protected $fillable = [
        'nama','phone','email','alamat','tgl_lahir','gender','status','created_at','updated_at'
  ];
}
