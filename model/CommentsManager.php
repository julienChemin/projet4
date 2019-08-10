<?php

class CommentsManager extends ReportManager{

	public function getComment(int $idCom){
		if($idCom > 0){
			return $this -> sql('
				SELECT id, id_article, content, nb_report, author, author_edit, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit
				FROM comments
				WHERE id = :idCom',
				[':idCom' => $idCom]);
		}
	}

	public function getComments(int $idArt){
		if($idArt > 0){
			return $this -> sql('
				SELECT id, id_article, content, nb_report, author, author_edit, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit
				FROM comments
				WHERE id_article = :id',
				[':id' => $idArt]);
		}
	}

	public function getLastComments(int $nb_comments){
		if($nb_comments > 0){
			return $this -> sql('
				SELECT id, id_article, content, nb_report, author, author_edit, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit
				FROM comments
				ORDER BY id DESC
				LIMIT 0, :nb_comments',
				[':nb_comments' => $nb_comments]);
		}
	}

	public function set(Comment $Comment){
		$this -> sql('
			INSERT INTO comments (id_article, content, author, date_publication)
			VALUES (:id_article, :content, :author, NOW())',
			[':id_article' => $Comment -> id_article(), ':content' => $Comment -> content(), ':author' => $Comment -> author()]);
	}

	public function update(Comment $Comment){
		$this -> sql('
			UPDATE comments
			SET content = :content, author_edit = :author_edit, date_edit = NOW()
			WHERE id = :id',
			[':content' => $Comment -> content(), ':author_edit' => $Comment -> author(), ':id' => $Comment -> id()]);
	}

	public function delete(int $idCom){
		if($idCom > 0){
			$this -> sql('
				DELETE FROM comments
				WHERE id = :id',
				[':id' => $idCom]);
		}
	}
}