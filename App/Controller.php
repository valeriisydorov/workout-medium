<?php


namespace App;

/**
 * Class Controller
 * @package App
 */
abstract class Controller
{
    protected $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @return bool
     */
    protected function access(): bool
    {
        return true;
    }

    /**
     * @param null $action
     */
    public function action($action = null): void
    {
        if ($this->access()) {
            $this->$action();
        } else {
            die('403');
        }
    }
}
