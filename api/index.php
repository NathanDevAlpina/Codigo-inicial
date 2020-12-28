<?php

use Psr\Http\Message\{
    ResponseInterface as Response,
    ServerRequestInterface as Request
};
use Slim\Factory\AppFactory;
use Source\Utils\Format;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "vendor", "autoload.php"]);

$app = AppFactory::create();
$app->setBasePath("/Codigo-inicial/api");
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get("/{class}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    
    $controller = new $controllerClass();
    $controller->findAll($request, $response);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->get("/{class}/{id}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    $field = "id";
    $value = (int)$args["id"];
    
    $controller = new $controllerClass();
    $controller->findFirstBy($request, $response, $field, $value);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->get("/{class}/{field}/{value}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    $field = Format::parameterRoute((string)$args["field"]);
    $value = $args["value"];
    
    $controller = new $controllerClass();
    $controller->findFirstBy($request, $response, $field, $value);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->post("/{class}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    
    $controller = new $controllerClass();
    $controller->create($request, $response);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->put("/{class}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    
    $controller = new $controllerClass();
    $controller->update($request, $response);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->delete("/{class}/{id}", function (Request $request, Response $response, array $args) {
    $class = Format::parameterRoute((string)$args["class"]);
    $controllerClass = "Source\\Controllers\\{$class}Controller";
    $id = (int)$args["id"];
    
    $controller = new $controllerClass();
    $controller->delete($request, $response, $id);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->run();