<?php

namespace Chemin\Blog\Model;

use Chemin\Blog\Model\AbstractManager;

abstract class ReportManager extends AbstractManager
{

	public function getMostReportedComments()
	{
		$query = $this->sql('
			SELECT id, idArticle, content, nbReport, author, authorIsAdmin, authorEdit, DATE_FORMAT(datePublication, "%d/%m/%Y à %H:%i.%s") AS datePublication, DATE_FORMAT(dateEdit, "%d/%m/%Y à %H:%i.%s") AS dateEdit
			FROM comments
			WHERE nbReport != 0
			ORDER BY nbReport DESC');

		$result = $query->fetchAll(\PDO::FETCH_CLASS, static::$OBJECT_TYPE);
			
		$query->closeCursor();

		return $result;
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

			return $this;
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

				return $this;
			}
		}
	}

	public function reportExists(int $id)
	{
		if ($id > 0) {
			$req = $this->sql(
				'SELECT *
				 FROM report
				 WHERE id = :id',
				[':id' => $id]);

			if ($result = $req->fetch()) {
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

			return $this;
		}
	}

	public function getReportsFromComment(int $idComment)
	{
		if ($idComment > 0) {
			$query = $this->sql('
				SELECT id, idReportedComment, author, content, DATE_FORMAT(dateReport, "%d/%m/%Y à %H:%i.%s") AS dateReport
				FROM report
				WHERE idReportedComment = :idReportedComment',
				[':idReportedComment' => $idComment]);

			$result = $query->fetchAll();

			$query->closeCursor();

			return $result;
		}
	}

	public function deleteReportsFromComment(int $idComment)
	{
		if ($idComment > 0) {
			$this->sql('
				DELETE FROM report
				WHERE idReportedComment = :idReportedComment',
				[':idReportedComment' => $idComment]);

			return $this;
		}
	}
}
