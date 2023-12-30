<?php

namespace Phpcatcom\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): HasMany
    {
//        return $this->hasMany(User::class,'role_id','id');
        return $this->hasMany(User::class);
    }

}
