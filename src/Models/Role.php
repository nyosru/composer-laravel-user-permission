<?php

namespace Phpcatcom\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'access_full'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function scopeAccessFull($query)
    {
        return $query->where('access_full', true);
    }

}
