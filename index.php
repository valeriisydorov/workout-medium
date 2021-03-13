<?php


use App\App;
use App\Exceptions\DbException;
use App\Exceptions\NotFoundException;
use App\Models\Logger;


require __DIR__ . '/App/autoload.php';


try {
    $app = App::getApp();
    $app();
} catch (\PDOException $e) {
    $logger = new Logger($e);
    print "Error!: " . $e->getMessage() . PHP_EOL;
    die();
} catch (DbException $e) {
    $logger = new Logger($e);
    print 'DB error: ' . $e->getMessage() . '; SQL query: ' . $e->getQuery() . PHP_EOL;
    die();
} catch (NotFoundException $e) {
    $logger = new Logger($e);
    print $e->getMessage() . $e->getCode() . PHP_EOL;
    die();
}
