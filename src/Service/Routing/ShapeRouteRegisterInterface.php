<?php

namespace App\Service\Routing;

interface ShapeRouteRegisterInterface
{
    /**
     * Gets the array of the shape's input parameters.
     *
     * @return array
     *   Array of the shape's input parameters.
     */
    public function getInputParams(): array;
}
