<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CustomerCode extends Model
{
    use HasFactory;
    protected $fillable = ['code','customer_id','status'];
}


