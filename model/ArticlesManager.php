<?php

class ArticlesManager extends AbstractManager
{
	public static $TABLE_NAME = 'articles';
	public static $TABLE_PK = 'id';
	public static $TABLE_CHAMPS ='id, author, authorEdit, title, content, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit';

	public function getArticles()
	{
		return $this -> sql(
			'SELECT id, author, authorEdit, title, content, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit 
			FROM articles
			ORDER BY id DESC');
	}

	public function getLastArticle()
	{
		return $this -> sql(
			'SELECT id, author, authorEdit, title, content, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit 
			FROM articles
			ORDER BY id DESC
			LIMIT 0, 1');
	}

	public function set(Article $Article)
	{
		$this -> sql(
			'INSERT INTO articles (author, title, content, datePublication) 
			VALUES(:author, :title, :content, NOW())',
			[':author' => $Article -> getAuthor(), ':title' => $Article -> getTitle(), ':content' => $Article -> getContent()]);

		return $this;
	}

	public function update(Article $Article)
	{
		$this -> sql(
			'UPDATE articles 
			SET authorEdit = :authorEdit, dateEdit = NOW(), content = :content, title = :title
			WHERE id = :id',
			[':authorEdit' => $Article -> getAuthorEdit(), ':title' => $Article -> getTitle(), ':content' => $Article -> getContent(), ':id' => $Article -> getId()]);

		return $this;
	}
}
