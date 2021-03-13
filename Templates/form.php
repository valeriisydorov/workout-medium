<?php
/** @var \App\View $this  */
?>

<form action="" method="post">
    <input type="text" name="title" placeholder="title" value="<?= $this->article->title ?? '' ?>"><br>
    <textarea name="content" cols="22" rows="8" placeholder="content"><?= $this->article->content ?? '' ?></textarea><br>
    <button type="submit" name="<?= $this->isNew ? 'create' : 'update' ?>"><?= $this->isNew ? 'Create' : 'Update' ?></button>
</form>
