<?php

namespace App\Controller;

use App\Model\Shape\ShapeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\CustomNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ShapeController extends AbstractController
{
    protected ValidatorInterface $validator;

    /**
     * Constructs ShapeController.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @ParamConverter("shape")
     */
    public function index(Request $request, ShapeInterface $shape): Response
    {
        $errors = $this->validator->validate($shape);
        if (count($errors) > 0) {
            $errorsResponse = [];
            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                $errorsResponse[$error->getPropertyPath()] = $error->getMessage();
            }
            $response = new JsonResponse($errorsResponse, 400);
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
            return $response;
        }

        $serializer = new Serializer([new CustomNormalizer()], [new JsonEncoder()]);
        return new JsonResponse($serializer->serialize($shape, JsonEncoder::FORMAT, [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]), 200, [], true);
    }
}
