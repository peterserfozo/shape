<?php

namespace App\Request\ParamConverter;

use App\Model\Shape\Factory\ShapeFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * ShapeParamConverter.
 */
class ShapeParamConverter implements ParamConverterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $name = $configuration->getName();
        $shape = ShapeFactory::getShape($request->get('_route'), $request->attributes->get('_route_params'));
        $request->attributes->set($name, $shape);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function supports(ParamConverter $configuration): bool
    {
        return true;
    }
}
