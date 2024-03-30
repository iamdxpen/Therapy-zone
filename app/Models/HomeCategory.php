<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class HomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title','link','display_order','status'];
    
    protected $table = 'home_categories';

    public function getAllHomeCategories($search = [], $sort = array(), $limit = null, $offset = null) {
        $sliderObj = self::select('*');

        if ($search['freetext'] != '') {
            $sliderObj->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('link', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('display_order', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'title','link','display_order','status', 'created_at', '');
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
