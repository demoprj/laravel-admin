<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// php artisan make:model XxUser
//class XxUser extends Model
class XxUser extends Authenticatable
{
    // use HasFactory;
    // use SoftDeletes;

    protected $table = 'xx_user';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    protected $hidden = [
        'bk',
        'password',
        'token',
    ];

    /*
    |----------------------------------------------------
    | MARK: Eloquent: Relationships
    |----------------------------------------------------
    */


    /*
    |----------------------------------------------------
    | MARK: Eloquent: Getting Started Query Scopes
    |----------------------------------------------------
    */

    public function scopeOnlyValid($query)
    {
        $query->where('status', '=', 1);
    }


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
