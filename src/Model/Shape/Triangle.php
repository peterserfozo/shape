<?php

namespace App\Model\Shape;

use App\Validator\TriangleInequalityTheorem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @TriangleInequalityTheorem
 */
class Triangle extends AbstractShape
{
    /**
     * Side A.
     *
     * @var float
     * @Assert\Positive
     */
    protected float $a;

    /**
     * Side B.
     *
     * @var float
     * @Assert\Positive
     */
    protected float $b;

    /**
     * Side C.
     *
     * @var float
     * @Assert\Positive
     */
    protected float $c;

    /**
     * @inheritDoc
     */
    public function calculateSurface(): float
    {
        $s = $this->calculateCircumference() / 2;
        return ($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
    }

    /**
     * @inheritDoc
     */
    public function calculateCircumference(): float
    {
        return $this->a + $this->b + $this->c;
    }

    /**
     * Gets side A.
     *
     * @return float
     *   Side A.
     */
    public function getA(): float
    {
        return $this->a;
    }

    /**
     * Gets side B.
     *
     * @return float
     *   Side B.
     */
    public function getB(): float
    {
        return $this->b;
    }

    /**
     * Gets side C.
     *
     * @return float
     *   Side C.
     */
    public function getC(): float
    {
        return $this->c;
    }
}
