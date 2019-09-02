<?php

class Comment
{
	private $id,
			$idArticle,
			$content,
			$author,
			$authorIsAdmin,
			$datePublication,
			$authorEdit,
			$dateEdit,
			$nbReport;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value){
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}

	//GETTERS
	public function getId()
	{
		return $this->id;
	}

	public function getIdArticle()
	{
		return $this->idArticle;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getAuthorIsAdmin()
	{
		return $this->authorIsAdmin;
	}

	public function getDatePublication()
	{
		return $this->datePublication;
	}

	public function getAuthorEdit()
	{
		return $this->authorEdit;
	}

	public function getDateEdit()
	{
		return $this->dateEdit;
	}

	public function getNbReport()
	{
		return $this->nbReport;
	}

	//SETTERS
	public function setId(int $idComment)
	{
		if ($idComment > 0) {
			$this->id = $idComment;
		}
	}

	public function setIdArticle(int $idArticle)
	{
		if ($idArticle > 0) {
			$this->idArticle = $idArticle;
		}
	}

	public function setContent(string $content)
	{
		if (strlen($content) > 0) {
			$this->content = $content;
		}
	}

	public function setAuthor(string $author)
	{
		if (strlen($author) > 0) {
			$this->author = $author;
		}
	}

	public function setAuthorIsAdmin(bool $isAdmin)
	{
		$this->authorIsAdmin = $isAdmin;
	}

	public function setDatePublication($date)
	{
		if (!empty($date)) {
			$this->datePublication = $date;
		}
	}

	public function setAuthorEdit(string $authorEdit)
	{
		if (strlen($authorEdit) > 0) {
			$this->authorEdit = $authorEdit;
		}
	}

	public function setDateEdit($dateEdit)
	{
		if (!empty($dateEdit)) {
			$this->dateEdit = $dateEdit;
		}
	}

	public function setNbReport(int $nbReport)
	{
		if ($nbReport >= 0) {
			$this->nbReport = $nbReport;
		}
	}
}
