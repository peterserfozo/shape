<?php

namespace App\Tests\Unit\Validator;

use App\Model\Shape\Triangle;
use App\Validator\TriangleInequalityTheorem;
use App\Validator\TriangleInequalityTheoremValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class TriangleInequalityTheoremValidatorTest extends TestCase
{
    public function testTriangleInequalityTheoremViolation(): void
    {
        $triangle = new Triangle([
            'a' => 1,
            'b' => 2,
            'c' => 4,
        ]);

        $triangleInequalityValidator = new TriangleInequalityTheoremValidator();

        /** @var ExecutionContextInterface|MockObject $executionContextMock */
        $executionContextMock = $this->getMockBuilder(ExecutionContextInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var ConstraintViolationBuilderInterface|MockObject $executionContextMock */
        $constraintViolationBuilderMock = $this->getMockBuilder(ConstraintViolationBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $executionContextMock
            ->expects($this->once())
            ->method('buildViolation')
            ->with('The sum of any two sides of a triangle must be greater than the measure of the third side.')
            ->willReturn($constraintViolationBuilderMock);

        /** @var Constraint|MockObject $constraintMock */
        $constraintMock = $this->getMockBuilder(TriangleInequalityTheorem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $triangleInequalityValidator->initialize($executionContextMock);
        $triangleInequalityValidator->validate($triangle, $constraintMock);
    }
}
