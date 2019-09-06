<?php

abstract class AbstractManager extends Database
{
	public function getOneById(int $id)
	{
		if($id > 0){
			return $this -> sql(
				'SELECT ' . static::$TABLE_CHAMPS . '
				 FROM ' . static::$TABLE_NAME . '
				 WHERE ' . static::$TABLE_PK . ' = :id',
				 [':id' => $id]);
		}
	}

	public function delete(int $id)
	{
		if($id > 0){
			$this -> sql(
				'DELETE FROM ' . static::$TABLE_NAME . '
				 WHERE ' . static::$TABLE_PK . ' = :id',
				 [':id' => $id]);
		}

		return $this;
	}
}