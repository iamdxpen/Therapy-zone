<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['image','display_order','webp_image','title','status'];

    public function getAllGalleries($search = [], $sort = array(), $limit = null, $offset = null) {
        $sliderObj = self::select('*');

        if ($search['freetext'] != '') {
            $sliderObj->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('display_order', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'title','image','display_order','status', 'created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $sliderObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $sliderObj->count();
        } else {
            $sliderObj->offset($offset);
            $sliderObj->limit($limit);
            return $sliderObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }
}
