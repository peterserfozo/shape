<?php

namespace App\Model\Shape;

interface ShapeInterface
{
    /**
     * Calculates the shape's surface.
     *
     * @return float
     *   The shape's surface.
     */
    public function calculateSurface(): float;

    /**
     * Calculates the shape's circumference.
     *
     * @return float
     *   The shape's circumference.
     */
    public function calculateCircumference(): float;
}
