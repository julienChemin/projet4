<?php

$newComment = new Comment([
'id_article' => $_POST['id_article'],
'author' => $_POST['post_comment_pseudo'],
'content' => $_POST['post_comment_content']]);

$CommentsManager -> set($newComment);

header('Location: Jean-Forteroche.php?action=article&id_article=' . $_POST["id_article"]);