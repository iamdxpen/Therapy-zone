<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'guard_name', 'remote_ip'];

    public function getAllRoles($search = [], $sort = array(), $limit = null, $offset = null) {
        $roleObj = self::select('*')->where('name', '!=', 'Superadmin')->checkGuard('admin');

        if ($search['freetext'] != '') {
            $roleObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name', 'status', 'created_at', '');
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

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeCheckGuard($query, $guard)
    {
        return $query->where('guard_name', $guard); 
    }
}
