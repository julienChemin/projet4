<?php

$newComment = new Comment([
'id_article' => $_POST['id_article'],
'author' => htmlspecialchars($_POST['post_comment_pseudo']),
'content' => htmlspecialchars($_POST['post_comment_content'])]);

$CommentsManager -> set($newComment);

header('Location: Jean-Forteroche.php?action=article&id_article=' . $_POST["id_article"]);