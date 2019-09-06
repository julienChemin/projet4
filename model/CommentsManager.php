<?php

class CommentsManager extends ReportManager
{
	public static $TABLE_NAME = 'comments';
	public static $TABLE_PK = 'id';
	public static $TABLE_CHAMPS ='id, idArticle, content, nbReport, author, authorIsAdmin, authorEdit, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit';

	public function getComments(int $idArticle)
	{
		if ($idArticle > 0) {
			return $this->sql('
				SELECT id, idArticle, content, nbReport, author, authorIsAdmin, authorEdit, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit
				FROM comments
				WHERE idArticle = :idArticle
				ORDER BY id DESC',
				[':idArticle' => $idArticle]);
		}
	}

	public function set(Comment $Comment)
	{
		if ($Comment->getAuthorIsAdmin()) {
			$this->sql('
				INSERT INTO comments (idArticle, content, author, authorIsAdmin, datePublication)
				VALUES (:idArticle, :content, :author, :authorIsAdmin, NOW())',
				[':idArticle' => $Comment->getIdArticle(), ':content' => $Comment->getContent(), ':author' => $Comment->getAuthor(),
				 ':authorIsAdmin' => true]);

			return $this;
		} else {
			$this->sql('
				INSERT INTO comments (idArticle, content, author, datePublication)
				VALUES (:idArticle, :content, :author, NOW())',
				[':idArticle' => $Comment->getIdArticle(), ':content' => $Comment->getContent(), ':author' => $Comment->getAuthor()]);

			return $this;
		}
	}

	public function update(Comment $Comment)
	{
		$this->sql('
			UPDATE comments
			SET content = :content, authorEdit = :authorEdit, author = :author, dateEdit = NOW()
			WHERE id = :id',
			[':content' => $Comment->getContent(), ':authorEdit' => $Comment->getAuthorEdit(), ':author' => $Comment->getAuthor(),
			 ':id' => $Comment->getId()]);

		return $this;
	}
}
