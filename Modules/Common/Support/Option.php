<?php


namespace Modules\Common\Support;

use Modules\Common\Helpers\Options\Options;


class Option extends Options
{
    /**
     * Option constructor.
     * @param array $options
     * @param Object $model
     */
    public function __construct(array $options, Object $model)
    {

        parent::__construct($options, $model);

    }

}
