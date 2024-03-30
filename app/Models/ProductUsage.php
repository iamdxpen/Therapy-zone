<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductUsage extends Model
{
    use HasFactory;
    protected $table = 'product_usage';
    protected $fillable = ['name','status'];

    public function getAllProductUsage($search = [], $sort = array(), $limit = null, $offset = null) {
        $productUsageObj = self::select('*');

        if ($search['freetext'] != '') {
            $productUsageObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $productUsageObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $productUsageObj->count();
        } else {
            $productUsageObj->offset($offset);
            $productUsageObj->limit($limit);
            return $productUsageObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
