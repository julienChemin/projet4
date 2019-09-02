<?php

abstract class ReportManager extends Database
{
	public function getMostReportedComments()
	{
		return $this->sql('
			SELECT id, idArticle, content, nbReport, author, authorIsAdmin, authorEdit, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit
			FROM comments
			WHERE nbReport != 0
			ORDER BY nbReport DESC');
	}

	public function setReport(int $idComment, string $author, string $content, int $nbReportBefore)
	{
		if ($idComment > 0 && $nbReportBefore >= 0 && strlen($author) > 0 && strlen($content) > 0) {
			//add 1 to Comment's nbReport
			$nbReport = $nbReportBefore + 1;
			$this->setNbReport($idComment, $nbReport);

			//add report to "report" table
			$this->sql('
				INSERT INTO report (idReportedComment, author, content, dateReport)
				VALUES (:idReportedComment, :author, :content, NOW())',
				[':idReportedComment' => $idComment, ':author' => $author, ':content' => $content]);
		}
	}

	public function deleteReport(int $idReport, int $idComment)
	{
		if ($idReport > 0 && $idComment > 0) {
			if ($this->reportExists($idReport)) {
				//delete report
				$this->sql('
					DELETE FROM report
					WHERE id = :id',
					[':id' => $idReport]);

				//minus 1 to Comment's nbReport
				$req = $this->getNbReport($idComment)->fetch();
				$nbReportBefore = (int) $req['nbReport'];
				$nbReport = $nbReportBefore - 1;

				$this->setNbReport($idComment, $nbReport);
			}
		}
	}

	public function reportExists(int $idReport)
	{
		if ($idReport > 0) {
			$req = $this->sql('
				SELECT *
				FROM report
				WHERE id = :id',
				[':id' => $idReport]);

			if ($report = $req->fetch()) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function getNbReport(int $idComment)
	{
		if ($idComment > 0) {
			return $this->sql('
				SELECT nbReport 
				FROM comments
				WHERE id = :idComment',
				[':idComment' => $idComment]);
		}
	}

	public function setNbReport(int $idComment, int $nbReport)
	{
		if ($idComment > 0 && $nbReport >= 0) {
			$this->sql('
				UPDATE comments 
				SET nbReport = :nbReport
				WHERE id = :idComment',
				[':idComment' => $idComment, ':nbReport' => $nbReport]);
		}
	}

	public function getReportsFromComment(int $idComment)
	{
		if ($idComment > 0) {
			return $this->sql('
				SELECT id, idReportedComment, author, content, DATE_FORMAT(dateReport, "%d/%m/%Y à %H:%i.%s") AS dateReport
				FROM report
				WHERE idReportedComment = :idReportedComment',
				[':idReportedComment' => $idComment]);
		}
	}

	public function deleteReportsFromComment(int $idComment)
	{
		if ($idComment > 0) {
			$this->sql('
				DELETE FROM report
				WHERE idReportedComment = :idReportedComment',
				[':idReportedComment' => $idComment]);
		}
	}
}
