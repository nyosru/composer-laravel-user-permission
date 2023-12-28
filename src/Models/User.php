<?php

namespace Phpcatcom\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

//    protected $fillable = ['name'];
    protected $table = 'users';

//    public function permissions()
//    {
//        return $this->belongsToMany(Permission::class);
//    }

}
