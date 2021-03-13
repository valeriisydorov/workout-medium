<?php
/** @var \App\View $this  */
?>

<a href="admin.php?ctrl=article&action=create">Create</a>
<?php foreach ($this->articles as $article): ?>
    <h2><?= $article->title ?></h2>
    <p><?= $article->content ?></p>
    <em><?= $article->author->name ?></em><br><br>
    <a href="admin.php?ctrl=article&action=update&id=<?= $article->id ?>">Update</a>
    <a href="admin.php?ctrl=article&action=delete&id=<?= $article->id ?>">Delete</a>
<?php endforeach; ?>
