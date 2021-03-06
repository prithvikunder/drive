<?php
abstract class Model 
{
	private $dbh;
	private $error;
	private $stmt;

	public function __construct()
	{
		// create database string
		$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
		$options = array(
							PDO::ATTR_PERSISTENT => true , 
							PDO::ATTR_ERRMODE	=>	PDO::ERRMODE_EXCEPTION
						);

		try {
			$this->dbh = new PDO($dsn,DB_USER,DB_PASS,$options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param,$value,$type=null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;

				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}

		$this->stmt->bindValue($param,$value,$type);
	}

	public function execute()
	{
		$this->stmt->execute();
	}

	public function resultSet()
	{
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function lastInsertedID()
	{
		return $this->dbh->lastInsertedID();
	}

	public function fetch()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
}
?>