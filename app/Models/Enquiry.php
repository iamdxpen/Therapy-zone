<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = ['name','organization','address','city','country','phone','email','subject','product','product_others','comments'];

    public function getAllEnquiry($search = [], $sort = array(), $limit = null, $offset = null) {
        $enquiryObj = self::select('*');

        if ($search['freetext'] != '') {
            $enquiryObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('organization', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('address', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('city', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('country', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('phone', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('email', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('subject', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('product_others', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('comments', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'subject','name','email','phone','country','created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $enquiryObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $enquiryObj->count();
        } else {
            $enquiryObj->offset($offset);
            $enquiryObj->limit($limit);
            return $enquiryObj->get();
        }
    }


}
