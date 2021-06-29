<?php declare(strict_types=1);

use App\Kernel;
use Nyholm\Psr7\Factory\Psr17Factory;

require dirname(__DIR__).'/vendor/autoload.php';

$kernel = new Kernel();

$requestFactory = new Psr17Factory();
$request = $requestFactory->createServerRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$response = $kernel->handle($request);
print((string)$response->getBody());
