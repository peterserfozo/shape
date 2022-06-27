<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TriangleInequalityTheorem extends Constraint
{
    public $message = 'The sum of any two sides of a triangle must be greater than the measure of the third side.';

    /**
     * {@inheritdoc}
     */
    public function getTargets(): array|string
    {
        return self::CLASS_CONSTRAINT;
    }
}
