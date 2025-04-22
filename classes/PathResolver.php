<?php

namespace App\Class;

class PathResolver
{
    /**
     * Base application path
     * @var string
     */
    private static $basePath;

    /**
     * Initialize the base path
     * @param string $basePath
     */
    public static function init($basePath)
    {
        self::$basePath = rtrim($basePath, '/');
    }

    /**
     * Resolve the page path based on the route
     * @param string $page
     * @return string
     */
    public static function resolve($route = 'home')
    {
        $routes = include(self::basePath('routes.php'));
        $route = trim($route, '/');

        if (isset($routes[$route])) {
            $pagePath = $routes[$route];

            if (is_string($pagePath) && file_exists($pagePath)) {
                return $pagePath;
            }
        }

        $parts = explode('/', $route);
        $baseRoute = $parts[0] ?? 'home';
        $id = $parts[1] ?? null;

        if (isset($routes[$baseRoute]) && is_string($routes[$baseRoute]) && file_exists($routes[$baseRoute])) {
            if ($id) {
                $_GET['id'] = $id;
            }
            return $routes[$baseRoute];
        }

        return self::basePath('pages/404.php');
    }




    /**
     * Get the base path
     * @param string $path Additional path to append
     * @return string
     */
    public static function basePath($path = '')
    {
        return self::$basePath . ($path ? '/' . ltrim($path, '/') : '');
    }
}
