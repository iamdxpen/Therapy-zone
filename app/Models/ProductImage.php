<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['image','product_id','is_main','display_order','status'];
}
