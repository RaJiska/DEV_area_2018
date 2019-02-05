<?php

class Database extends PDO
{
	public function __construct()
	{
		try {
			parent::__construct(
				'mysql:host=' . $GLOBALS['config']['database']['host'] . ';dbname=' . $GLOBALS['config']['database']['name'],
				$GLOBALS['config']['database']['user'],
				$GLOBALS['config']['database']['pass'], array(
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_PERSISTENT => true
				)
			);
		}
		catch (PDOException $e) {
			throw new PDOException("Database Error: " . $e->getMessage());
		}
	}

	public function executeTransaction($queries, $binds, $ret_lastid = false)
	{
		$return = true;
		try
		{
			$this->beginTransaction();
			foreach($queries as $key => $query)
			{
				$stmt = $this->prepare($queries[$key]);
				$stmt->execute($binds[$key]);
			}
			if ($ret_lastid)
				$return = $this->lastInsertId();
			$this->commit();
		}
		catch (PDOException $e)
		{
			$this->rollBack();
			throw $e;
		}
		return $return;
	}
}