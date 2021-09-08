<?php

namespace Modules\Common\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

/**
 * @method where(\Closure $param)
 * @method whereHas($relationship, \Closure $param)
 * @method orWhereHas($relationship, \Closure $param)
 */
class EloquentProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // add the eloquent macro
        Builder::macro('search', function( $field, $value ){
            if( $value ) {
                return $this->where( function ( $query ) use ( $field, $value ) {
                    $value ? $query->where( $field, 'LIKE', '%' . $value . '%' ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('strictSearch', function( $field, $value ){
            if( $value ) {
                return $this->where( function ( $query ) use ( $field, $value ) {
                    $value ? $query->where( $field, $value ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('searchIn', function( $field, $values ){
            if ($values) {
                return $this->where( function( $query ) use ( $field, $values ) {
                    $values ? $query->whereIn( $field, $values ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('searchRelationship', function( $relationship, $field, $value ){
            if ($value) {
                return $this->whereHas( $relationship , function( $query ) use ( $field, $value ) {
                    $value ? $query->where( $field, 'LIKE', '%' . $value . '%' ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('orSearchRelationship', function( $relationship, $field, $value ){
            if ($value) {
                return $this->orWhereHas( $relationship , function( $query ) use ( $field, $value ) {
                    $value ? $query->where( $field, 'LIKE', '%' . $value . '%' ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('searchRelationshipNull', function( $relationship, $field ){
            return $this->whereHas( $relationship , function( $query ) use ( $field ) {
                $query->whereNull( $field);
            } );
            return $this;
        });

        Builder::macro('searchStrictRelationship', function( $relationship, $field, $value ){
            if ($value) {
                return $this->whereHas( $relationship , function( $query ) use ( $field, $value ) {
                    $value ? $query->where( $field, $value ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('searchStrictRelationshipIn', function( $relationship, $field, $values ){
            if ($values) {
                return $this->whereHas( $relationship , function( $query ) use ( $field, $values ) {
                    $values ? $query->whereIn( $field, $values ) : true;
                } );
            }
            return $this;
        });

        Builder::macro('timeSpan', function ( $timeSpan, $field = 'created_at' ){
            return $timeSpan ? $this->whereBetween( $field, $timeSpan ) : $this;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
