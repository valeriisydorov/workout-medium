<?php


namespace App;

/**
 * Class App
 * @package App
 */
class App
{
    protected $uri;
    private static $app = [];

    /**
     * App constructor.
     */
    protected function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @return array
     */
    protected function getRoute(): array
    {
        return explode('/', parse_url($this->uri, PHP_URL_PATH));
    }

    /**
     * @return string|null
     */
    protected function controllerRoute(): ?string
    {
        return $this->getRoute()[1] ?? null;
    }

    protected function getController(): string
    {
        $controllerName = $this->controllerRoute() ? ucfirst($this->controllerRoute()) : 'Site';

        $className = '\App\Controllers\\' . $controllerName;

        try {
            if (!class_exists($className)) {
                throw new \Exception('404');
            } else {
                return $className;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return string|null
     */
    protected function actionRoute(): ?string
    {
        return $this->getRoute()[2] ?? null;
    }

    /**
     * @return string
     */
    protected function getAction()
    {
        $actionName = $this->actionRoute() ?? 'index';

        try {
            if (!method_exists($this->getController(), $actionName)) {
                throw new \Exception('404');
            } else {
                return $actionName;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return int|null
     */
    protected function identifierRoute(): ?int
    {
        return $this->getRoute()[3] ?? null;
    }

    /**
     * @return int|null
     */
    public function getIdentifier(): ?int
    {
        return $this->identifierRoute();
    }

    protected function run()
    {
        $controllerName = $this->getController();
        $controller = new $controllerName();
        $controller->action($this->getAction());
    }

    public function __invoke(): void
    {
        $this->run();
    }

    protected function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * @return App
     */
    public static function getApp(): App
    {
        $obj = static::class;
        if (!isset(self::$app[$obj])) {
            self::$app[$obj] = new static();
        }

        return self::$app[$obj];
    }
}
