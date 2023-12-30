<?php

namespace Phpcatcom\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'action',
//        'method',
        'domain'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
//    public function roles()
//    {
//        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
//    }
}
