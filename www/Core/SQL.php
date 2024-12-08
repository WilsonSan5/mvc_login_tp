<?php

namespace App\Core;

class SQL
{
	private $pdo;

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
	public function getOneById(string $table, int $id): array
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
		$allowedTables = ['user', 'orders', 'products'];  // List of allowed tables
		$allowedFields = ['email', 'id', 'username'];     // List of allowed fields

		if (!in_array($table, $allowedTables) || !in_array($field, $allowedFields)) {
			throw new \InvalidArgumentException("Invalid table or field provided.");
		};
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
		$dataKeys = array_keys($data);
		$dataValues = array_values($data);
		$query = "INSERT INTO $tableName (" . implode(", ", $dataKeys) . ") VALUES (:" . implode(", :", $dataKeys) . ")";
		$queryPrepared = $this->pdo->prepare($query);
		return $queryPrepared->execute(array_combine($dataKeys, $dataValues));
	}
}
