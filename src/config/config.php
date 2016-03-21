<?php

/**
 * This file is part of Astro,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Roketin\Astro
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Astro Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by Astro to create correct relations.  Update
    | the role if it is in a different namespace.
    |
     */
    'role'                  => 'App\Role',

    /*
    |--------------------------------------------------------------------------
    | Astro Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by Astro to save roles to the database.
    |
     */
    'roles_table'           => 'roles',

    /*
    |--------------------------------------------------------------------------
    | Astro Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by Astro to create correct relations.
    | Update the permission if it is in a different namespace.
    |
     */
    'permission'            => 'App\Permission',

    /*
    |--------------------------------------------------------------------------
    | Astro Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by Astro to save permissions to the
    | database.
    |
     */
    'permissions_table'     => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | Astro permission_role Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by Astro to save relationship
    | between permissions and roles to the database.
    |
     */
    'permission_role_table' => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | Astro role_user Table
    |--------------------------------------------------------------------------
    |
    | edited by Ivan Andhika
    | This is the role_user table used by Astro to save assigned roles to the
    | database.
    |
     */
    'role_user_table'       => 'role_user',

];
