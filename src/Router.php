<?php

declare(strict_types=1);

namespace Lib;

use InvalidArgumentException;

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function get(string $route, array $routeCallSettings): void
    {
        self::$routes['GET'][$route] = $routeCallSettings;
    }

    public static function post(string $route, array $routeCallSettings): void
    {
        self::$routes['POST'][$route] = $routeCallSettings;
    }

    public static function resolve(): array
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $uri = $_SERVER['REQUEST_URI'] ?? '';

        // Separate the path from query string
        $uriParts = explode('?', $uri, 2);
        $path = $uriParts[0];
        $queryString = $uriParts[1] ?? '';

        if (empty($httpMethod) || !isset(self::$routes[$httpMethod])) {
            throw new InvalidArgumentException(
                sprintf('HTTP method %s is not supported', $httpMethod)
            );
        }

        // Match route and get dynamic parameters
        $routeMatch = self::matchRoute($path, $httpMethod);

        if (!$routeMatch) {
            http_response_code(404);
            echo '404 Not Found';
            return [];
        }

        [$routeAction, $routeParams] = $routeMatch;

        parse_str($queryString, $queryParams);

        // Return route action, dynamic route params, and query params
        return compact('routeAction', 'routeParams', 'queryParams');
    }

    private static function matchRoute(string $path, string $method): array|null
    {
        foreach (self::$routes[$method] as $route => $routeCallSettings) {
            // Convert {param} to a regex capture group
            $routePattern = preg_replace('/{[\w_]+}/', '([^/]+)', $route);
            $routePattern = '/^' . str_replace('/', '\/', $routePattern) . '$/';

            if (preg_match($routePattern, $path, $matches)) {
                // Remove the full match from the array
                array_shift($matches);

                // Extract parameter names from route
                preg_match_all('/{(\w+)}/', $route, $paramNames);
                $paramNames = $paramNames[1]; // Extract parameter names

                // Map route parameters to their values
                $routeParams = [];
                foreach ($paramNames as $index => $paramName) {
                    if (isset($matches[$index])) {
                        $routeParams[$paramName] = $matches[$index];
                    }
                }

                return [$routeCallSettings, $routeParams];
            }
        }

        return null;
    }

    public static function redirect(string $url, int $statusCode = 302)
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }

    public static function back()
    {
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            self::redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
