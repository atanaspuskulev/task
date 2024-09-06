<?php

declare(strict_types=1);

namespace Lib;

use ReflectionClass;
use InvalidArgumentException;

class Container
{
    private array $bindings = [];

    public function set(string $name, callable $resolver): void
    {
        $this->bindings[$name] = $resolver;
    }

    public function get(string $name)
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]($this);
        }

        return $this->resolve($name);
    }

    private function resolve(string $class)
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException(
                sprintf('Class %s not found', $class)
            );
        }

        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        // Automatically resolve constructor dependencies
        $dependencies = $constructor ? array_map(
            fn($param) => $this->resolveParam($param),
            $constructor->getParameters()
        ) : [];

        $instance = $reflectionClass->newInstanceArgs($dependencies);

        // If the class has a setView method, inject the View instance
        if (method_exists($instance, 'setView')) {
            $instance->setView($this->get(View::class));
        }

        return $instance;
    }

    private function resolveParam($parameter)
    {
        $type = $parameter->getType();
        if ($type && !$type->isBuiltin()) {
            return $this->get($type->getName());
        }

        throw new InvalidArgumentException(
            sprintf('Cannot resolve class dependency %s', $parameter->getName())
        );
    }
}
