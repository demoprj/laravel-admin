<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// php artisan make:model XxTest
class XxTest extends BaseModel
{
    // use HasFactory;
    // use SoftDeletes;

    protected $table = 'xx_test';
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

    public function xxTestDetails()
    {
        return $this->hasMany(XxTestDetail::class, 'testId');    // column of other TBL
    }

    public function owner_obj()
    {
        return $this->belongsTo(XxUser::class, 'ownerId');    // column of self
    }

    public function created_by_obj()
    {
        return $this->belongsTo(XxUser::class, 'created_by');    // column of self
    }

    public function updated_by_obj()
    {
        return $this->belongsTo(XxUser::class, 'updated_by');    // column of self
    }

    public function deleted_by_obj()
    {
        return $this->belongsTo(XxUser::class, 'deleted_by');    // column of self
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

    protected $appends = ['test_name'];
    public function getTestNameAttribute($value)
    {
        return "{$this->name} - {$this->value}";
    }


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
