<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Mail;
use DB;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $data = [
            $this->email
        ];

        Mail::send('Admin.Email.reset-password', [
            'name' => $this->name,
            'reset_url' => route('admin.password.reset', ['token' => $token, 'email' => $this->email])
        ], function($message) use($data){
            $message->subject('Reset Password Request');
            $message->to($data[0]);
        });
    }

    public function getAllUsers($search = [], $sort = array(), $limit = null, $offset = null) {
        $userObj = self::select('*')->where('id', '!=', 1);

        if ($search['freetext'] != '') {
            $userObj->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('email', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere('status', 'like', "%" . $search["freetext"] . "%");
                $query->orWhere(DB::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i:%s')"), "like", "%" . $search['freetext'] . "%");
            });
        }
        $fields = array('', 'name', 'email', '', 'status', 'created_at', '');
        if (!empty($sort)) {
            foreach ($sort as $index => $type) {
                if (!empty($fields[$index])) {
                    $userObj->orderBy($fields[$index], $type);
                }
            }
        }

        if (empty($limit)) {
            return $userObj->count();
        } else {
            $userObj->offset($offset);
            $userObj->limit($limit);
            return $userObj->get();
        }
    }
}
