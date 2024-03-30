<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getAllSetting() {
        $responseData = [];
        $settingData = self::all();
        if(!empty($settingData)){
            foreach ($settingData as $value){
                $responseData[$value->key] = $value->value;
            }
        }
        return $responseData;
    }

    public static function getSettingByKey($key) {
        return self::select('value')->where('key',$key)->first();
    }
}
