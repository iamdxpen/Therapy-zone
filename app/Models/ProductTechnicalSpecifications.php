<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductTechnicalSpecifications extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','technical_specification_id','value'];

    public function technicalSpecification(){
    	return $this->hasOne(TechnicalSpecifications::class, 'id', 'technical_specification_id');
    }

}
