<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductUseType extends Model
{
    use HasFactory;
    protected $table = 'product_use_types';
    protected $fillable = ['name','status'];

    public function getAllProductUseTypes($search = [], $sort = array(), $limit = null, $offset = null) {
        $productUseTypeObj = self::select('*');

        if ($search['freetext'] != '') {
            $productUseTypeObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $productUseTypeObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $productUseTypeObj->count();
        } else {
            $productUseTypeObj->offset($offset);
            $productUseTypeObj->limit($limit);
            return $productUseTypeObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
