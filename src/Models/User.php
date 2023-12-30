<?php

namespace Phpcatcom\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    public $timestamps = false;

//    protected $fillable = ['name'];
    protected $table = 'users';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }







    public function role(): BelongsTo
    {
//        return $this->belongsTo(Role::class,'id','role_id');
//        return $this->belongsTo(Role::class,'rple_id','id');
        return $this->belongsTo(Role::class);
    }

//    /**
//     * Get the phone associated with the user.
//     */
//    public function roles(): HasOne
//    {
////        return $this->hasOne(Role::class, 'id', 'role_id');
//        return $this->belongsTo(Post::class);
//    }

//    public function roles()
//    {
//        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
//    }
}
