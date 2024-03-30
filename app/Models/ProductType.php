<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_types';
    
    protected $fillable = ['name','status'];

    public function getAllProductTypes($search = [], $sort = array(), $limit = null, $offset = null) {
        $productTypeObj = self::select('*');

        if ($search['freetext'] != '') {
            $productTypeObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $productTypeObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $productTypeObj->count();
        } else {
            $productTypeObj->offset($offset);
            $productTypeObj->limit($limit);
            return $productTypeObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
