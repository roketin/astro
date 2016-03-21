<?php
namespace Roketin\Astro\Contracts;

/**
 * This file is part of Astro,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Roketin\Astro
 */

interface AstroPermissionInterface
{

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
