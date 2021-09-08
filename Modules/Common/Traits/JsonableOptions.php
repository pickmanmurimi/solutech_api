<?php

namespace Modules\Common\Traits;


use Modules\Common\Support\Option;

/**
 * Trait JsonableOptions
 * @package Modules\Common\Traits
 */
trait JsonableOptions
{

    /**
     * @return Option
     */
    public function OptionsObject() : Option
    {
        $options = ($this->options) ?: [];

        return new Option( (array) $options, $this);
    }

    /**
     * @return Option
     */
    public function getOptionsObjectAttribute() : Option
    {
        return $this->OptionsObject();
    }
}
