<?php

class ArticlesManager extends Database{
	public function getArticles(){
		return $this -> sql(
			'SELECT id, author, author_edit, title, content, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit 
			FROM articles
			ORDER BY id DESC');
	}

	public function getArticle(int $id){
		if($id > 0){
			return $this -> sql(
				'SELECT id, author, author_edit, title, content, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit 
				FROM articles 
				WHERE id = :id', 
				[':id' => $id]);
		}
	}

	public function getLastArticle(){
		return $this -> sql(
			'SELECT id, author, author_edit, title, content, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit 
			FROM articles
			ORDER BY id DESC
			LIMIT 0, 1');
	}

	public function set(Article $Article){
		$this -> sql(
			'INSERT INTO articles (author, title, content, date_publication, date_edit) 
			VALUES(:author, :title, :content, NOW(), null)',
			[':author' => $Article -> author(), ':title' => $Article -> title(), ':content' => $Article -> content()]);
	}

	public function update(Article $Article){
		$this -> sql(
			'UPDATE articles 
			SET author_edit = :author_edit, date_edit = NOW(), content = :content
			WHERE id = :id',
			[':author_edit' => $Article -> author(), ':title' => $Article -> title(), ':content' => $Article -> content(), ':id' => $Article -> id()]);
	}

	public function delete(int $id){
		if($id > 0){
			$this -> sql(
				'DELETE FROM articles
				WHERE id = ' . $id);
		}
	}
}