<?php

namespace App;

use Spatie\Permission\Models\Permission as SP;

class Permission extends SP
{

    public static function allPermissions()
    {
        return collect([
            'Users.add',        // can create new users (but not roles and permissions)
            'Users.edit',       // can change user details (but not roles and permissions)
            'Users.delete',     // can delete users
            'Users.roles',      // can assign and delete roles on users but scoped to their own roles
            'Users.roles.all',  // can assign and delete any role to user
            'Users.permissions',// can assign permissions on users 

            'Roles.manage',     // can perform all role and permission maintenance but scoped to their own roles and permissions
            'Roles.manage.all', // can perform all role and permission maintenance

            'Foodbanks.add',    // can create new foodbanks

            'Contacts.add',     // can create new contacts
            'Clubs.add',        // can create new clubs
            'Shippers.add',     // can create new shippers
            'Suppliers.add',    // can create new suppliers

        ]);
    }
}
