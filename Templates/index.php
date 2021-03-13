<?php
/** @var \App\View $this */
?>

<?php foreach ($this->articles as $article): ?>
    <h2>
        <a href="article/view/<?= $article->id ?>"><?= $article->title ?></a>
    </h2>
    <p><?= $article->content ?></p>
    <p><em><?= $article->author->name ?></em></p>
<?php endforeach; ?>

<?= $this->resourceUsage ?>
