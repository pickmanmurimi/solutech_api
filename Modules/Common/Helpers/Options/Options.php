<?php
namespace Modules\Common\Helpers\Options;

use Exception;
use Illuminate\Support\Arr;

abstract class Options
{
    /**
     * @var $model
     */
    protected $model;
    /**
     * The list of options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Create a new softiya helpers options instance.
     *
     * @param array $options
     * @param $model
     */
    public function __construct(array $options, $model)
    {
        $this->options = $options;
        $this->model = $model;
    }

    /**
     * Retrieve the given option.
     *
     * @param string $key
     *
     * @return string
     */
    public function get($key)
    {
        return Arr::get($this->options, $key);
    }

    /**
     * Create and persist a new option.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;
        $this->persist();
    }

    /**
     * Determine if the given option exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->options);
    }

    /**
     * Retrieve an array of all option.
     *
     * @return array
     */
    public function all()
    {
        return $this->options;
    }

    /**
     * remove an option
     *
     * @param  mixed $key
     *
     * @return void
     */
    public function remove($key)
    {
        unset( $this->options[$key] );
        $this->persist();
    }

    /**
     * Merge the given attributes with the current option.
     * But do not assign any new option.
     *
     * @param array $attributes
     *
     * @return mixed
     */

    public function merge(array $attributes)
    {
        $this->options = array_merge(
            $this->options,
            Arr::only($attributes, array_keys($this->options))
        );
        return $this->persist();
    }

    /**
     * push
     *
     * @param  mixed $key
     * @param  mixed $value
     *
     * @return mixed
     */
    public function push( $key , array $value )
    {
        array_push($this->options[ $key ], $value);

        return $this->persist();
    }

    /**
     * Persist the options.
     *
     * @return mixed
     */
    protected function persist()
    {
        return $this->model->update(['options' => $this->options]);
    }

    /**
     * Magic property access for options.
     *
     * @param string $key
     *
     * @throws Exception
     *
     * @return
     */
    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }
        throw new Exception("The {$key} options does not exist.");
    }

}
