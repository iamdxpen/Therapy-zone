<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductUseIn extends Model
{
    use HasFactory;
    protected $table = 'product_use_in';
    protected $fillable = ['name','status'];

    public function getAllProductUsein($search = [], $sort = array(), $limit = null, $offset = null) {
        $productUseinObj = self::select('*');

        if ($search['freetext'] != '') {
            $productUseinObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $productUseinObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $productUseinObj->count();
        } else {
            $productUseinObj->offset($offset);
            $productUseinObj->limit($limit);
            return $productUseinObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
