<?php

namespace App\Model\Shape;

use Symfony\Component\Validator\Constraints as Assert;

class Circle extends AbstractShape
{
    /**
     * Radius.
     *
     * @var float
     * @Assert\Positive
     */
    protected float $radius;

    /**
     * @inheritDoc
     */
    public function calculateSurface(): float
    {
        return $this->radius * $this->radius * pi();
    }

    /**
     * @inheritDoc
     */
    public function calculateCircumference(): float
    {
        return 2 * $this->radius * pi();
    }
}
