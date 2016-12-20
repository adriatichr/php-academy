<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';

$kernel = new AppKernel('prod', false);

// Symfony developeri preporučuju da se loadClassCache ne koristi u PHP 7 jer uzrokuje greške u kombinaciji sa HTTP
// cache-om
//
// https://github.com/symfony/symfony/issues/20560#issuecomment-266477399
// $kernel->loadClassCache();

$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
