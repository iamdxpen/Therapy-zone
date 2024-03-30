<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Pages extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','content','meta_title','meta_keyword','meta_description','status'];

    public function getAllpages($search = [], $sort = array(), $limit = null, $offset = null) {
        $pagesObj = self::select('*');

        if ($search['freetext'] != '') {
            $pagesObj->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('content', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_keyword', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('meta_description', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'title','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $pagesObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $pagesObj->count();
        } else {
            $pagesObj->offset($offset);
            $pagesObj->limit($limit);
            return $pagesObj->get();
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
