<?php

namespace App\Core;

class SQL
{
	private \PDO $pdo;
	private array $tablesAllowed = ['user'];
	private array $allowedFields = ['email', 'id', 'lastname', 'firstname', 'password'];
	private const FETCH_MODE = \PDO::FETCH_OBJ;

	public function __construct()
	{
		try {
			$this->pdo = new \PDO("mysql:host=mariadb;dbname=esgi", "esgi", "esgipwd");
		} catch (\Exception $e) {
			die("Erreur SQL " . $e->getMessage());
		}
	}

	/**
	 * The method to get the rows from a table based on the id
	 * @param string $table
	 * @param int $id
	 * @return array
	 */
	public function getOneById(string $table, int $id): object
	{
		$queryPrepared = $this->pdo->prepare("SELECT * FROM " . $table . " WHERE id= :id");
		$queryPrepared->execute([
			"id" => $id
		]);
		return $queryPrepared->fetch(self::FETCH_MODE);
	}

	/**
	 * The method to get one row by field
	 * @param string $table
	 * @param string $field
	 * @param $value
	 * @return mixed
	 */
	public function getOneByField(string $table, string $field, $value): mixed
	{
		// Validate table and field to prevent SQL injection
		$this->checkTable($table);

		$queryPrepared = $this->pdo->prepare("SELECT * FROM " . $table . " WHERE $field = :value");
		$queryPrepared->execute([
			"value" => $value
		]);
		return $queryPrepared->fetch(self::FETCH_MODE);
	}

	/**
	 * The method to insert data into a table
	 * @param string $tableName
	 * @param array $data
	 * @return bool
	 */
	public function insertData(string $tableName, array $data): bool
	{
		// Check if the table is allowed
		$this->checkTable($tableName);
		$this->checkField(array_keys($data));
		// Get the keys and values of the data array to use them in the query
		$dataKeys = array_keys($data);
		$dataValues = array_values($data);
		$query = "INSERT INTO $tableName (" . implode(", ", $dataKeys) . ") VALUES (:" . implode(", :", $dataKeys) . ")";
		$queryPrepared = $this->pdo->prepare($query);
		return $queryPrepared->execute(array_combine($dataKeys, $dataValues));
	}

	/**
	 * The method to update data in a table
	 * @param string $tableName
	 * @param array $data
	 * @param int $id
	 * @return bool
	 */
	public function updateData(string $tableName, array $data, int $id): bool
	{
		// Check if the table is allowed
		$this->checkTable($tableName);
		// Get the keys of the data array to use them in the query
		$dataKeys = array_keys($data);
		// Build the query
		$query = "UPDATE $tableName SET ";

		// Build the query with the keys of the data array
		foreach ($dataKeys as $key) {
			$query .= "$key = :$key, ";
		}
		// Remove the last comma
		$query = substr($query, 0, -2);
		// Add the WHERE clause
		$query .= " WHERE id = :id";
		$queryPrepared = $this->pdo->prepare($query);
		// Add the id to the data array
		$data['id'] = $id;
		return $queryPrepared->execute($data);
	}


	/**
	 * @param string $tableName
	 * @return void
	 */
	private function checkTable(string $tableName): void
	{
		if (!in_array($tableName, $this->tablesAllowed)) {
			throw new \InvalidArgumentException("Invalid table provided.");
		}
	}

	private function checkField(array $fields): void
	{
		foreach ($fields as $field) {
			if (!in_array($field, $this->allowedFields)) {
				throw new \InvalidArgumentException("Invalid field provided. $field");
			}
		}
	}
}
