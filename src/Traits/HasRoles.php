<?php

namespace PhpCatCom\Traits;

use PhpCatCom\Models\Role;

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
