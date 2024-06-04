<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Spa extends Model
{
    use HasFactory;
    protected $fillable = ['title','mobile','address','package_id','status','time'];

    public function getAllSpas($search = [], $sort = array(), $limit = null, $offset = null) {
        $roleObj = self::select('*');

        if ($search['freetext'] != '') {
            $roleObj->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('mobile', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('address', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('package_id', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'title','mobile','package_id','status', 'created_at');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $roleObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $roleObj->count();
        } else {
            $roleObj->offset($offset);
            $roleObj->limit($limit);
            return $roleObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }

    public function package(){
    	return $this->hasOne(SpaPackage::class, 'id', 'package_id');
    }
}


