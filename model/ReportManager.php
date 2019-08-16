<?php

abstract class ReportManager extends Database{

	public function getMostReportedComments(){
		return $this -> sql('
			SELECT id, id_article, content, nb_report, author, author_edit, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit
			FROM comments
			WHERE nb_report != 0
			ORDER BY nb_report DESC');
	}

	public function getLastReportedComments(int $nb_reported_comments){
		if($nb_reported_comments > 0){
			return $this -> sql('
				SELECT id, id_reported_comment, content, author, DATE_FORMAT(date_report, "%d/%m/%Y à %H:%i.%s") AS date_report
				FROM report
				ORDER BY id DESC
				LIMIT 0, :nb_reported_comments',
				[":nb_reported_comments" => $nb_reported_comments]);
		}
	}

	public function resetNbReport(int $idCom){
		//get back "nb_report" to 0
		if($idCom > 0){
			$this -> sql('
				UPDATE comments 
				SET nb_report = 0
				WHERE id = :idCom',
				[':idCom' => $idCom]);
		}
	}

	public function report(int $idCom, string $author, string $content, int $nb_report_before){
		if($idCom > 0 && $nb_report_before >= 0 && strlen($author) > 0 && strlen($content) > 0){
			$nb_report = $nb_report_before + 1;

			//add 1 to Comment's nb_report
			$this -> sql('
				UPDATE comments 
				SET nb_report = :nb_report
				WHERE id = :id',
				[':nb_report' => $nb_report, ':id' => $idCom]);

			//add report to "report" table
			$this -> sql('
				INSERT INTO report (id_reported_comment, author, content, date_report)
				VALUES (:id_reported_comment, :author, :content, NOW())',
				[':id_reported_comment' => $idCom, ':author' => $author, ':content' => $content]);
		}
	}
}