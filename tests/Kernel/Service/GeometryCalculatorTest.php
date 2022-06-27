<?php

namespace App\Tests\Kernel\Service;

use App\Model\Shape\Circle;
use App\Model\Shape\Triangle;
use App\Service\GeometryCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GeometryCalculatorTest extends KernelTestCase
{
    public function testSumOfSurfaces(): void
    {
        self::bootKernel();
        $geometryCalculator = static::getContainer()->get(GeometryCalculator::class);

        $triangleA = new Triangle([
            'a' => 2,
            'b' => 3,
            'c' => 4,
        ]);
        $triangleB = new Triangle([
            'a' => 6,
            'b' => 7,
            'c' => 8,
        ]);
        $this->assertSame(421.875, $geometryCalculator->sumSurfaces($triangleA, $triangleB));
    }

    public function testSumOfCircumferences(): void
    {
        self::bootKernel();
        $geometryCalculator = static::getContainer()->get(GeometryCalculator::class);

        $circleA = new Circle([
            'radius' => 2,
        ]);
        $circleB = new Circle([
            'radius' => 13,
        ]);
        $this->assertSame(94.2477796076938, $geometryCalculator->sumCircumference($circleA, $circleB));
    }
}
