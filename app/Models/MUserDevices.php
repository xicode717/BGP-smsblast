<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MUserDevices extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'user_device';
    protected $fillable = [
        'id','name','phone','token','status','created_at','updated_at'
  ];
}
