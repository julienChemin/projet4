<?php

class ArticlesManager extends Database
{
	public function getArticles()
	{
		return $this -> sql(
			'SELECT id, author, authorEdit, title, content, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit 
			FROM articles
			ORDER BY id DESC');
	}

	public function getArticle(int $id)
	{
		if($id > 0){
			return $this -> sql(
				'SELECT id, author, authorEdit, title, content, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit 
				FROM articles 
				WHERE id = :id', 
				[':id' => $id]);
		}
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
	}

	public function update(Article $Article)
	{
		$this -> sql(
			'UPDATE articles 
			SET authorEdit = :authorEdit, dateEdit = NOW(), content = :content, title = :title
			WHERE id = :id',
			[':authorEdit' => $Article -> getAuthorEdit(), ':title' => $Article -> getTitle(), ':content' => $Article -> getContent(), ':id' => $Article -> getId()]);
	}

	public function delete(int $id)
	{
		if($id > 0){
			$this -> sql(
				'DELETE FROM articles
				WHERE id = ' . $id);
		}
	}
}
