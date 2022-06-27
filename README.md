# Horus Music test

Horus Music application.

## Getting Started
1. Run `docker-compose build --pull --no-cache` to build fresh images
2. Run `docker-compose up` (the logs will be displayed in the current shell)
3. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
4. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Features
* `ShapeLoader` to dynamically register routes for shapes (looking for Shape models)
* `ShapeParamConverter` and `ShapeFactory` to simply construct shape objects and pass them to the controller.
* Validators to validate shape objects
* Custom validator `TriangleInequalityTheoremValidator` to validate triangles.
* Build JSON responses in `ShapeController` using custom `normalize()` implementation.
* `GeometryCalculator` service to sum surfaces and circumferences.
* Different types of tests can be found under `/tests`

[Troubleshooting](docs/troubleshooting.md)
