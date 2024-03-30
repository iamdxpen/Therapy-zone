<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class TechnicalSpecifications extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];

    public function getAllTechnicalSpecifications($search = [], $sort = array(), $limit = null, $offset = null) {
        $technicalSpecificationsObj = self::select('*');

        if ($search['freetext'] != '') {
            $technicalSpecificationsObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name','status','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $technicalSpecificationsObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $technicalSpecificationsObj->count();
        } else {
            $technicalSpecificationsObj->offset($offset);
            $technicalSpecificationsObj->limit($limit);
            return $technicalSpecificationsObj->get();
        }
    }

    public function scopeActive($query) {
        return $query->where('status','=','Active');
    }

    public function ProductTechnicalSpecifications(){
    	return $this->hasOne(ProductTechnicalSpecifications::class, 'technical_specification_id', 'id');
    }
}
