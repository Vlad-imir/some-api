<?php

namespace App;

/**
 * Class Container
 */
class Container
{
    /**
     * @var array
     */
    private $map = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->map = require '../config/map.php';
    }

    /**
     * @param $name
     * @param array $params
     * @return object
     */
    public function get($name, array $params = [])
    {
        $class = new \ReflectionClass($name);
        $constructor = $class->getConstructor();

        $constructorParams = [];
        if ($constructor) {
            /**
             * $constructorParams - classNames required in class constructor
             */
            $constructorParams = array_map(function ($el) {
                return $el->getClass()->name;
            }, $constructor->getParameters());

            /**
             *  Filter params that already passed
             */
            $cnt = count($params);
            if ($cnt) {
                $constructorParams = array_slice($constructorParams, $cnt);
            }
        }

        /**
         * Create object for each  constructor param
         */
        foreach ($constructorParams as $one)
        {
            $value = $one;
            if (array_key_exists($value, $this->map)) {
                $value = $this->handleMapVal($this->map[$value]);
            }

            $params[] = is_object($value) ? $value : self::get($value);
        }

        return $class->newInstanceArgs($params);

    }

    private function handleMapVal($value)
    {
        if (is_callable($value)) {
            $value = $value();
        }

        return $value;
    }
}