<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class SpaData extends Model
{
    use HasFactory;
    protected $fillable = ['code','customer_id','spa_id','status'];
    protected $table = 'spa_datas';

    public function getAllSpaData($search = [], $sort = array(), $limit = null, $offset = null) {
        $roleObj = self::select('*');

        if ($search['freetext'] != '') {
            $roleObj->where(function ($query) use ($search) {
                $query->orWhere('code', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('customer_id', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('spa_id', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'spa_name','spa_mobile','spa_package','customer_name','customer_mobile','customer_package','code','status', 'created_at');
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

    public function spa(){
    	return $this->hasOne(Spa::class, 'id', 'spa_id');
    }

    public function customer(){
    	return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

}


