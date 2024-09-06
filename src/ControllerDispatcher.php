<?php

declare(strict_types=1);

namespace Lib;

use InvalidArgumentException;
use ReflectionMethod;

class ControllerDispatcher
{

    public function __construct(private Container $container)
    {
    }

    public function dispatch(array $action, array $routeParams): mixed
    {
        [$class, $method] = $action;

        if (!class_exists($class)) {
            throw new InvalidArgumentException(
                sprintf('Controller class %s not found', $class)
            );
        }

        $controller = $this->container->get($class);

        if (!method_exists($controller, $method)) {
            throw new InvalidArgumentException(
                sprintf('Method %s was not found in controller %s', $method, $class)
            );
        }

        $reflection = new ReflectionMethod($controller, $method);
        $parameters = $reflection->getParameters();
        $args = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            if ($type && !$type->isBuiltin()) {
                $args[] = $this->container->get($type->getName());
            } else {
                // Check if a parameter is provided in routeParams
                $paramName = $parameter->getName();
                $args[] = $routeParams[$paramName] ?? null;
            }
        }

        return $reflection->invokeArgs($controller, $args);
    }
}
