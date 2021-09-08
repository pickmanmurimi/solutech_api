<?php
namespace Modules\Common\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Trait UsesUuid
 * @package Modules\Common\Traits
 */
trait UsesUuid
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public static function findUuid($uuid )
    {
        return static::whereUuid( $uuid )->firstOrFail();
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public static function getIdFromUUid($uuid )
    {
        return optional(static::whereUuid( $uuid )->firstOrFail())->id;
    }
}
