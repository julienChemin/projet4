<?php

abstract class ReportManager extends Database{

	public function getMostReportedComments(){
		return $this -> sql('
			SELECT id, id_article, content, nb_report, author, author_is_admin, author_edit, DATE_FORMAT(date_publication, "%d/%m/%Y à %H:%i.%s") AS date_publication, DATE_FORMAT(date_edit, "%d/%m/%Y à %H:%i.%s") AS date_edit
			FROM comments
			WHERE nb_report != 0
			ORDER BY nb_report DESC');
	}

	public function setReport(int $idComment, string $author, string $content, int $nb_report_before){
		if($idComment > 0 && $nb_report_before >= 0 && strlen($author) > 0 && strlen($content) > 0){
			//add 1 to Comment's nb_report
			$nb_report = $nb_report_before + 1;
			$this -> setNbReport($idComment, $nb_report);

			//add report to "report" table
			$this -> sql('
				INSERT INTO report (id_reported_comment, author, content, date_report)
				VALUES (:id_reported_comment, :author, :content, NOW())',
				[':id_reported_comment' => $idComment, ':author' => $author, ':content' => $content]);
		}
	}

	public function deleteReport(int $idReport, int $idComment){
		if($idReport > 0 && $idComment > 0){
			if($this -> reportExists($idReport)){
				//delete report
				$this -> sql('
					DELETE FROM report
					WHERE id = :id',
					[':id' => $idReport]);

				//minus 1 to Comment's nb_report
				$req = $this -> getNbReport($idComment) -> fetch();
				$nb_report_before = (int) $req['nb_report'];
				$nb_report = $nb_report_before - 1;

				$this -> setNbReport($idComment, $nb_report);
			}
		}
	}

	public function reportExists(int $idReport){
		if($idReport > 0){
			$req = $this -> sql('
				SELECT *
				FROM report
				WHERE id = :id',
				[':id' => $idReport]);

			if($report = $req -> fetch()){
				return true;
			}
			else{
				return false;
			}
		}
	}

	public function getNbReport(int $idComment){
		if($idComment > 0){
			return $this -> sql('
				SELECT nb_report 
				FROM comments
				WHERE id = :idComment',
				[':idComment' => $idComment]);
		}
	}

	public function setNbReport(int $idComment, int $nb_report){
		if($idComment > 0 && $nb_report >= 0){
			$this -> sql('
				UPDATE comments 
				SET nb_report = :nb_report
				WHERE id = :idComment',
				[':idComment' => $idComment, ':nb_report' => $nb_report]);
		}
	}

	public function getReportsFromComment(int $idComment){
		if($idComment > 0){
			return $this -> sql('
				SELECT id, id_reported_comment, author, content, DATE_FORMAT(date_report, "%d/%m/%Y à %H:%i.%s") AS date_report
				FROM report
				WHERE id_reported_comment = :id_reported_comment',
				[':id_reported_comment' => $idComment]);
		}
	}

	public function deleteReportsFromComment(int $idComment){
		if($idComment > 0){
			$this -> sql('
				DELETE FROM report
				WHERE id_reported_comment = :id_reported_comment',
				[':id_reported_comment' => $idComment]);
		}
	}
}