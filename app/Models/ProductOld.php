<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductOld extends Model
{
    protected $connection = 'mysql_old';
    protected $table = 'tbl_products';
}
