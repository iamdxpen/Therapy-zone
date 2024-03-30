<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name','country_code','phone_code','status'];

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
