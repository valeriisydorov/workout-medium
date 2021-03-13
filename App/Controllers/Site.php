<?php


namespace App\Controllers;


use App\Controller;
use App\Models\Article;

use SebastianBergmann\Timer\ResourceUsageFormatter;
use SebastianBergmann\Timer\Timer;


/**
 * Class Site
 * @package App\Controllers
 */
class Site extends Controller
{
    protected function index(): void
    {
        $timer = new Timer;
        $timer->start();

        $this->view->articles = Article::recent(Article::RECENT);

        $this->view->resourceUsage = (new ResourceUsageFormatter)->resourceUsage($timer->stop());

        $this->view->display(__DIR__ . '/../../Templates/index.php');
    }
}
