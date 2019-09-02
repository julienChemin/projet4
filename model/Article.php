<?php

class Article
{
	private $id,
			$author,
			$title,
			$content,
			$datePublication,
			$authorEdit,
			$dateEdit;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	//GETTERS
	public function getId()
	{
		return $this->id;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getContent()
	{
		return $this->content;
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

	//SETTERS
	public function setId(int $id)
	{
		if ($id > 0){
			$this->id = $id;
		}
	}

	public function setAuthor(string $author)
	{
		if (strlen($author) > 0 && strlen($author) <=100){
			$this->author = $author;
		}
	}

	public function setTitle(string $title)
	{
		if (strlen($title) > 0 && strlen($title) <= 255){
			$this->title = $title;
		}
	}

	public function setContent(string $content)
	{
		if (strlen($content) > 0){
			$this->content = $content;
		}
	}

	public function setDatePublication($date)
	{
		if (!empty($date)){
			$this->datePublication = $date;
		}
	}

	public function setAuthorEdit(string $authorEdit)
	{
		if (strlen($authorEdit) > 0 && strlen($authorEdit) <=100){
			$this->authorEdit = $authorEdit;
		}
	}

	public function setDateEdit($dateEdit)
	{
		if (!empty($dateEdit)){
			$this->dateEdit = $dateEdit;
		}
	}
}
