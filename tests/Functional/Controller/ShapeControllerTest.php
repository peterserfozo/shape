<?php

namespace App\Tests\Functional\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ShapeControllerTest extends ApiTestCase
{
    public function testValidCircleRequest(): void
    {
        static::createClient()->request('GET', '/circle/5');
        $this->assertResponseIsSuccessful();
        $this->assertJsonEquals([
            'type' => 'circle',
            'radius' => '5.000000',
            'surface' => '78.539816',
            'circumference' => '31.415927',
        ]);
    }

    public function testValidTriangleRequest(): void
    {
        static::createClient()->request('GET', '/triangle/3/4/5');
        $this->assertResponseIsSuccessful();
        $this->assertJsonEquals([
            'type' => 'triangle',
            'a' => '3.000000',
            'b' => '4.000000',
            'c' => '5.000000',
            'surface' => '36.000000',
            'circumference' => '12.000000',
        ]);
    }

    public function testInvalidCircleRequest(): void
    {
        static::createClient()->request('GET', '/circle/0');
        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonEquals([
            'radius' => 'This value should be positive.',
        ]);

        static::createClient()->request('GET', '/circle/-1');
        $this->assertResponseStatusCodeSame(404);

        static::createClient()->request('GET', '/circle/abc');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testInvalidTriangleRequest(): void
    {
        static::createClient()->request('GET', '/triangle/0/0/0');
        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonEquals([
            'a,b,c' => 'The sum of any two sides of a triangle must be greater than the measure of the third side.',
            'a' => 'This value should be positive.',
            'b' => 'This value should be positive.',
            'c' => 'This value should be positive.',
        ]);

        static::createClient()->request('GET', '/triangle/-1/-2/-3');
        $this->assertResponseStatusCodeSame(404);

        static::createClient()->request('GET', '/triangle/abc/abc/abc');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testTriangleInequalityTheoremRequest(): void
    {
        static::createClient()->request('GET', '/triangle/1/2/3');
        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonEquals([
            'a,b,c' => 'The sum of any two sides of a triangle must be greater than the measure of the third side.',
        ]);
    }
}
