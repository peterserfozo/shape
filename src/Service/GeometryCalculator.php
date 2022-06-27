<?php

namespace App\Service;

use App\Model\Shape\ShapeInterface;

class GeometryCalculator
{
    /**
     * Calculates sum of two shapes' surfaces.
     *
     * @param ShapeInterface $shapeA
     *   Shape A.
     * @param ShapeInterface $shapeB
     *   Shape B.
     *
     * @return float
     *   The sum of the two surfaces.
     */
    public function sumSurfaces(ShapeInterface $shapeA, ShapeInterface $shapeB): float
    {
        return $shapeA->calculateSurface() + $shapeB->calculateSurface();
    }

    /**
     * Calculates sum of two shapes' circumferences.
     *
     * @param ShapeInterface $shapeA
     *   Shape A.
     * @param ShapeInterface $shapeB
     *   Shape B.
     *
     * @return float
     *   The sum of the two circumferences.
     */
    public function sumCircumference(ShapeInterface $shapeA, ShapeInterface $shapeB): float
    {
        return $shapeA->calculateCircumference() + $shapeB->calculateCircumference();
    }
}
