<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class TriangleInequalityTheoremValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate($triangle, Constraint $constraint): void
    {
        if ($triangle->getA() + $triangle->getB() <= $triangle->getC()
            || $triangle->getA() + $triangle->getC() <= $triangle->getB()
            || $triangle->getB() + $triangle->getC() <= $triangle->getA()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('a, b, c')
                ->addViolation();
        }
    }
}
