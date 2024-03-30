<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        // 'product_use_type' => 'array'
    ];

    protected $fillable = ['name','slug','short_description','description','technical_description','electrical_description','product_type','product_used_in','product_use_type','product_usage','meta_title','meta_keyword','meta_description','status'];

    public function getAllProducts($search = [], $sort = array(), $limit = null, $offset = null) {
        $productObj = self::select('*');

        if ($search['freetext'] != '') {
            $productObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('slug', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('short_description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('technical_description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('electrical_description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product_type', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product_used_in', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product_use_type', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product_usage', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_keyword', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('','name','product_type','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $productObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $productObj->count();
        } else {
            $productObj->offset($offset);
            $productObj->limit($limit);
            return $productObj->get();
        }
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('display_order', 'ASC');
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->where('is_main', 1);
    }
    
    public function productType(){
    	return $this->hasOne(ProductType::class, 'id', 'product_type');
    }

    public function productUseIn(){
    	return $this->hasOne(ProductUseIn::class, 'id', 'product_used_in');
    }

    public function productUseType(){
    	return $this->hasOne(ProductUseType::class, 'id', 'product_use_type');
    }

    public function productUsage(){
    	return $this->hasOne(ProductUsage::class, 'id', 'product_usage');
    }

    public function technicalSpecifications(){
    	return $this->hasMany(ProductTechnicalSpecifications::class, 'product_id', 'id');
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
