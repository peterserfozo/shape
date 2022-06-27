<?php

namespace App\Tests\Unit\Service\Routing;

use App\Model\Shape\Circle;
use App\Model\Shape\Triangle;
use App\Service\Routing\ShapeLoader;
use PHPUnit\Framework\TestCase;

class ShapeLoaderTest extends TestCase
{
    public function testShapeLoaderLoadShapes(): void
    {
        $shapeLoader = new ShapeLoader();
        $shapes = $shapeLoader->loadShapes();
        $this->assertCount(2, $shapes);
        $this->assertInstanceOf(Circle::class, $shapes[0]);
        $this->assertInstanceOf(Triangle::class, $shapes[1]);
    }

    public function testShapeLoaderBuildRouteName(): void
    {
        $shapeLoader = new ShapeLoader();
        $triangle = new Triangle();
        $circle = new Circle();
        $this->assertEquals('circle', $shapeLoader->buildRouteName($circle));
        $this->assertEquals('triangle', $shapeLoader->buildRouteName($triangle));
    }

    public function testShapeLoaderBuildPath(): void
    {
        $shapeLoader = new ShapeLoader();
        $triangle = new Triangle();
        $circle = new Circle();
        $this->assertEquals('circle/{radius<^[0-9]+(\.[0-9]+)?$>}', $shapeLoader->buildPath($circle));
        $this->assertEquals('triangle/{a<^[0-9]+(\.[0-9]+)?$>}/{b<^[0-9]+(\.[0-9]+)?$>}/{c<^[0-9]+(\.[0-9]+)?$>}', $shapeLoader->buildPath($triangle));
    }
}
