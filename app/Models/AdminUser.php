<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /*
    |----------------------------------------------------
    | MARK: Eloquent: Relationships
    |----------------------------------------------------
    */

    public function xxUser()
    {
        return $this->hasOne(XxUser::class, 'xx_uid');    // column of self
    }
}
