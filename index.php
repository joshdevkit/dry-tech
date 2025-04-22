<?php

define('BASE_URL', '/dry-tech');


use App\Class\Database;
use App\Class\PathResolver;
use App\Class\Session;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = Database::getInstance();
$GLOBALS['db'] = $db;
Session::start();

PathResolver::init(__DIR__);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$route = trim(str_replace($base, '', $uri), '/');

$route = $route ?: 'home';

require_once PathResolver::resolve($route);

function asset($path)
{
    return BASE_URL . '/' . ltrim($path, '/');
}
