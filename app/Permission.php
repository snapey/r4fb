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

            'Foodbanks.view',   // can look at foodbanks
            'Foodbanks.add',    // can create new foodbanks
            'Foodbanks.approve',// can approve a foodbank to recieve foundation grants
            'Foodbanks.edit',   // can edit a foodbank, including delete

            'Contacts.view',    // can view contacts
            'Contacts.add',     // can create new contacts
            'Contacts.edit',    // can edit contacts, including delete

            'Clubs.view',       // can view clubs
            'Clubs.add',        // can create new clubs
            'Clubs.edit',       // can edit rotary clubs, including delete

            'Shippers.view',    // cab view shippers
            'Shippers.add',     // can create new shippers
            'Suppliers.add',    // can create new suppliers

            'Shipments.view',    // can view shipments
            'Suppliers.view',    // can view suppliers

            'Allocations.view',  // can view allocations
            'Allocations.add',  // can create new allocations

            'Items.view',       // can view items
            'Items.add',        // can create new items

            'Orders.view',       // can view orders
            'Orders.add',        // can add new orders
            'Orders.edit',       // can edit orders

            'Emails.templates.view', // can look at email templates
            'Emails.list',       // can look at emails that have been sent

            'Addresses.edit',    // can edit (create / update delete addresses) 

            'Subscriptions.edit', // user can manage their own subscriptions

            // limiting permission
            'ResearchContactsOnly' // user can only see contacts that are theirs for research
        ]);
    }
}
