<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class SpaImage extends Model
{
    use HasFactory;
    protected $fillable = ['spa_id','image','display_order'];

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
