<?php

namespace App\Model\Shape;

use App\Service\Routing\ShapeRouteRegisterInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractShape implements ShapeInterface, ShapeRouteRegisterInterface, NormalizableInterface
{
    /**
     * Constructs a shape from an array of parameters.
     *
     * @param array $params
     *   Array of parameters.
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getInputParams(): array
    {
        $class = new \ReflectionClass($this);
        $properties = $class->getProperties();
        array_walk($properties, function (&$item) {
            $item = $item->getName();
        });
        return $properties;
    }

    /**
     * @inheritDoc
     */
    public function normalize(NormalizerInterface $normalizer, string $format = null, array $context = []): array
    {
        $numberFormat = function ($number) {
            return number_format($number, 6);
        };

        $properties = get_object_vars($this);
        array_walk($properties, function (&$item) use ($numberFormat) {
            $item = $numberFormat($item);
        });
        return [
                'type' => strtolower((new \ReflectionClass($this))->getShortName()),
            ] + $properties + [
                'surface' => $numberFormat($this->calculateSurface()),
                'circumference' => $numberFormat($this->calculateCircumference()),
            ];
    }
}
