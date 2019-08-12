<?php

class Comment{

	private $_id,
			$_id_article,
			$_content,
			$_author,
			$_date_publication,
			$_author_edit,
			$_date_edit,
			$_nb_report;

	public function __construct(array $data){
		$this -> hydrate($data);
	}

	public function hydrate(array $data){
		foreach($data as $key => $value){
			$method = 'set' . ucfirst($key);

			if(method_exists($this, $method)){
				$this -> $method($value);
			}
		}
	}

	//GETTERS
	public function id(){
		return $this -> _id;
	}

	public function id_article(){
		return $this -> _id_article;
	}

	public function content(){
		return $this -> _content;
	}

	public function author(){
		return $this -> _author;
	}

	public function date_publication(){
		return $this -> _date_publication;
	}

	public function author_edit(){
		return $this -> _author_edit;
	}

	public function date_edit(){
		return $this -> _date_edit;
	}

	public function nb_report(){
		return $this -> _nb_report;
	}

	//SETTERS
	public function setId(int $idCom){
		if($idCom > 0){
			$this -> _id = $idCom;
		}
	}

	public function setId_article(int $idArt){
		if($idArt > 0){
			$this -> _id_article = $idArt;
		}
	}

	public function setContent(string $content){
		if(strlen($content) > 0){
			$this -> _content = $content;
		}
	}

	public function setAuthor(string $author){
		if(strlen($author) > 0){
			$this -> _author = $author;
		}
	}

	public function setDate_publication($date){
		if(!empty($date)){
			$this -> _date_publication = $date;
		}
	}

	public function setAuthor_edit(string $author_edit){
		if(strlen($author_edit) > 0){
			$this -> _author_edit = $author_edit;
		}
	}

	public function setDate_edit($date_edit){
		if(!empty($date_edit)){
			$this -> _date_edit = $date_edit;
		}
	}

	public function setNb_report(int $nb_report){
		if($nb_report >= 0){
			$this -> _nb_report = $nb_report;
		}
	}
}