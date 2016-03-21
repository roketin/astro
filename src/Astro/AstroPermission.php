<?php
namespace Roketin\Astro;

/**
 * This file is part of Astro,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Roketin\Astro
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Roketin\Astro\Contracts\AstroPermissionInterface;
use Roketin\Astro\Traits\AstroPermissionTrait;

class AstroPermission extends Model implements AstroPermissionInterface
{
    use AstroPermissionTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('astro.permissions_table');
    }

}
