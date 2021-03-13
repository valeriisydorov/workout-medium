<?php


namespace App\Controllers\Admin;


use App\Controller;
use \App\Models\Article as ArticleModel;


/**
 * Class Article
 * @package App\Controllers\Admin
 */
class Article extends Controller
{
//    protected function access(): bool
//    {
//        return isset($_GET['name']) && $_GET['name'] === 'Valery';
//    }

    protected function index(): void
    {
//        $this->view->articles = ArticleModel::findAll();
        $this->view->articles = ArticleModel::quickFindAll();
        $this->view->display(__DIR__ . '/../../../Templates/admin.php');
    }

    protected function all(): void
    {
        $functions = [
            'title' => function(ArticleModel $article) {
                return $article->title;
            },
            'trimmedText' => function(ArticleModel $article) {
                return mb_strimwidth($article->content, 0, 100);
            }
        ];
        $models = ArticleModel::quickFindAll();
        $dataTable = new AdminDataTable($models, $functions);

        $this->view->table = $dataTable->render();

        $this->view->display(__DIR__ . '/../../../Templates/view.php');
    }

    protected function create(): void
    {
        ob_start();
        $this->view->article = new ArticleModel();
        $this->view->isNew = true;
        $this->view->display(__DIR__ . '/../../../Templates/form.php');

        if (isset($_POST['create']) && $_POST['title'] !== '' && $_POST['content'] !== '') {
            $this->view->article->title = trim($_POST['title']);
            $this->view->article->content = trim($_POST['content']);
            $this->view->article->save();
            ob_end_clean();
            header('Location: /admin.php?ctrl=article&action=index');
            exit();
        }
    }

    protected function update(): void
    {
        ob_start();
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $model = ArticleModel::findById($_GET['id']);
            if ($model) {
                $this->view->article = $model;
                $this->view->article->isNew = false;
                $this->view->display(__DIR__ . '/../../../Templates/form.php');
            }

            if (isset($_POST['update']) && $_POST['title'] !== '' && $_POST['content'] !== '') {
                $this->view->article->title = trim($_POST['title']);
                $this->view->article->content = trim($_POST['content']);
                $this->view->article->save();
                ob_end_clean();
                header('Location: /admin.php?ctrl=article&action=index');
                exit();
            }
        }
    }

    protected function delete(): void
    {
        ob_start();
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $article = ArticleModel::findById($_GET['id']);
            if ($article) {
                $article->delete();
                ob_end_clean();
                header('Location: /admin.php?ctrl=article&action=index');
                exit();
            }
        }
    }
}
