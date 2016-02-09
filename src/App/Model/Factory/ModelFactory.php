<?php

namespace App\Model\Factory;

use Interop\Container\ContainerInterface;
use ReflectionClass;

class ModelFactory
{
    /**
     * Creates a new class instance from given arguments.
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Construct a new ReflectionClass object for the requested action
        $reflection = new ReflectionClass($requestedName);

        // Return the requested class
        return $reflection->newInstance();
    }
}