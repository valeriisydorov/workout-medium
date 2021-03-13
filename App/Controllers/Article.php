<?php


namespace App\Controllers;


use App\App;
use App\Controller;
use App\Exceptions\NotFoundException;
use App\Model;

/**
 * Class Article
 * @package App\Controllers
 */
class Article extends Controller
{
//    protected function access(): bool
//    {
//        return isset($_GET['name']) && $_GET['name'] === 'Valery';
//    }

    protected function index(): void
    {
        $this->view->articles = \App\Models\Article::findAll();
        $this->view->display(__DIR__ . '/../../Templates/index.php');
    }

    protected function view(): void
    {
        $id = App::getApp()->getIdentifier();
        $model = $this->findModel($id);
        if ($model) {
            $this->view->article = $model;
            $this->view->display(__DIR__ . '/../../Templates/article.php');
        }
    }

    /**
     * @param $id
     * @return Model|null
     */
    protected function findModel($id): ?Model
    {
        $model = \App\Models\Article::findById($id);
        if (!$model) {
            throw new NotFoundException('Page not found: ', '404');
        } else {
            return $model;
        }
    }
}
