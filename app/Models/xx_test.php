<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ★★★★★ 出错点 ★★★★★
// 错误演示专用，不推荐在Model名称内使用"_"
// php artisan make:model xx_test
class xx_test extends Model
{
    // use HasFactory;
    protected $table = 'xx_test';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
