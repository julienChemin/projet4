<?php

class Article{

	private $_id,
			$_author,
			$_title,
			$_content,
			$_date_publication,
			$_author_edit,
			$_date_edit;

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
	public function author(){
		return $this -> _author;
	}
	public function title(){
		return $this -> _title;
	}
	public function content(){
		return $this -> _content;
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

	//SETTERS
	public function setId(int $id){
		if(is_int($id) && $id > 0){
			$this -> _id = $id;
		}
	}
	public function setAuthor(string $author){
		if(strlen($author) > 0 && strlen($author) <=100){
			$this -> _author = $author;
		}
	}
	public function setContent(string $content){
		if(strlen($content) > 0){
			$this -> _content = $content;
		}
	}
	public function setTitle(string $title){
		if(strlen($title) > 0 && strlen($title) <= 255){
			$this -> _title = $title;
		}
	}
	public function setDate_publication($date){
		if(!empty($date)){
			$this -> _date_publication = $date;
		}
	}
	public function setAuthor_edit($author_edit){
		if(is_string($author_edit) && strlen($author_edit) > 0 && strlen($author_edit) <=100){
			$this -> _author_edit = $author_edit;
		}
	}
	public function setDate_edit($date_edit){
		if(!empty($date_edit)){
			$this -> _date_edit = $date_edit;
		}
	}
}