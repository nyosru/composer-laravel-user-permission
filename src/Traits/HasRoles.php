<?php

namespace Phpcatcom\Permission\Traits;

use Phpcatcom\Permission\Models\Role;

trait HasRoles
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getRoleNameAttribute(){
        return $this->role()->first()->name ?? null ;
    }
}
