<?php


require __DIR__ . '/App/autoload.php';


$queries = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

parse_str($queries, $output);

if (isset($output['ctrl'])) {
    $className = '\App\Controllers\Admin\\' . ucfirst($output['ctrl']);
    try {
        if (!class_exists($className)) {
            throw new \Exception('404');
        } else {
            $controller = new $className();
        }
    } catch (\Exception $e) {
        die($e->getMessage());
    }
}

if (isset($output['action'])) {
    $actionName = $output['action'];
    try {
        if (!method_exists($className, $actionName)) {
            throw new \Exception('404');
        } else {
            $controller->action($actionName);
        }
    } catch (\Exception $e) {
        die($e->getMessage());
    }
}
