<?php

namespace App\Controller\Factory;

use Interop\Container\ContainerInterface;
use ReflectionClass;

class InterfaceFactory
{
    /**
     * Creates a new class instance from given arguments.
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return object
     * @throws \ErrorException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Remove Interface from request name
        $requestedName = preg_replace('/Interface/', '', $requestedName);

        // Construct a new ReflectionClass object for the requested action
        $reflection = new ReflectionClass($requestedName);

        // Return the requested instance
        return $reflection->newInstance();
    }
}