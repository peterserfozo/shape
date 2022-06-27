<?php

namespace App\Model\Shape\Factory;

use App\Model\Shape\ShapeInterface;

/**
 * ShapeFactory to construct shape objects from valid requests.
 */
class ShapeFactory
{
    /**
     * Constructs a shape object based on the route name and parameters.
     *
     * @param string $route
     *   The route name.
     * @param array $routeParams
     *   The array of route parameters.
     * @return ShapeInterface
     *   The constructed shape object.
     */
    public static function getShape(string $route, array $routeParams): ShapeInterface {
        $route = 'App\\Model\\Shape\\' . ucwords($route);
        return new $route($routeParams);
    }
}
