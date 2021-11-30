<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// php artisan make:model XxTestDetail
class XxTestDetail extends BaseModel
{
    // use HasFactory;
    // use SoftDeletes;

    protected $table = 'xx_test_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $hidden = [
        'bk'
    ];

    /*
    |----------------------------------------------------
    | MARK: Eloquent: Relationships
    |----------------------------------------------------
    */

    public function xxTest()
    {
        return $this->belongsTo(XxTest::class, 'testId');    // column of self
    }


    /*
    |----------------------------------------------------
    | MARK: Eloquent: Getting Started Query Scopes
    |----------------------------------------------------
    */


    /*
    |----------------------------------------------------
    | MARK: Eloquent: Mutators & Casting
    |----------------------------------------------------
    */

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d',
    ];


    /*
    |----------------------------------------------------
    | MARK: Eloquent: API Resources
    |----------------------------------------------------
    */


    /*
    |----------------------------------------------------
    | MARK: misc
    |----------------------------------------------------
    */
}
