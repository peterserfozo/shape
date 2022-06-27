<?php

namespace App\Service\Routing;

use App\Controller\ShapeController;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Dynamically adds routes for shapes.
 */
class ShapeLoader implements LoaderInterface
{
    const REQUIREMENT_FLOAT = '^[0-9]+(\.[0-9]+)?$';

    /**
     * {@inheritdoc}
     */
    public function load(mixed $resource, string $type = null): mixed
    {
        $routeCollection = new RouteCollection();
        /** @var ShapeRouteRegisterInterface $shape */
        foreach ($this->loadShapes() as $shape) {
            $route = new Route($this->buildPath($shape), [
                '_controller' => ShapeController::class . '::index',
            ]);
            $route->setMethods('GET');
            $route->setOptions($shape->getInputParams());
            $routeCollection->add($this->buildRouteName($shape), $route);
        }

        return $routeCollection;
    }

    /**
     * Loads all shapes.
     *
     * @param string $namespace
     *   Namespace required for a class to be considered a shape.
     * @param string $search_root_path
     *   Search classes recursively starting from this folder.
     *
     * @return object[]
     *   Array of instantiated shapes.
     */
    protected function loadShapes(string $namespace = 'App\Model\Shape', string $search_root_path = __DIR__ . '/../../Model/Shape'): array
    {
        $finder = new Finder();
        $finder->files()->in($search_root_path)->name('*.php');
        foreach ($finder as $file) {
            $className = rtrim($namespace, '\\') . '\\' . $file->getFilenameWithoutExtension();
            if (class_exists($className) && in_array(ShapeRouteRegisterInterface::class, class_implements($className))) {
                try {
                    $shapes[] = new $className([]);
                } catch (\Throwable $e) {
                    continue;
                }
            }
        }

        return $shapes ?? [];
    }

    /**
     * Builds the route name for the given shape.
     *
     * @param ShapeRouteRegisterInterface $shape
     *   The shape.
     *
     * @return string
     *   The route's name.
     */
    protected function buildRouteName(ShapeRouteRegisterInterface $shape): string {
        return strtolower((new \ReflectionClass($shape))->getShortName());
    }

    /**
     * Builds the route path for the given shape.
     *
     * @param ShapeRouteRegisterInterface $shape
     *   The shape.
     *
     * @return string
     *   The route's path.
     */
    protected function buildPath(ShapeRouteRegisterInterface $shape): string {
        $params = $shape->getInputParams();
        array_walk($params, function(&$item) {
            $item = '{' . $item . '<' . self::REQUIREMENT_FLOAT . '>}';
        });
        return empty($params) ? $this->buildRouteName($shape) : $this->buildRouteName($shape) . '/' . implode('/', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null): bool
    {
        return $type === 'shape';
    }

    /**
     * {@inheritdoc}
     */
    public function getResolver(): LoaderResolverInterface
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setResolver(LoaderResolverInterface $resolver): void
    {
    }
}
