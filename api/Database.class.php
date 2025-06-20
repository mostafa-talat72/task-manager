<?php
class Database
{
	private $host;
	private $db_name;
	private $username;
	private $password;
	public $conn;

	public function __construct()
	{
		$this->host = "localhost";
		$this->db_name = "task_manager";
		$this->username = "root";
		$this->password = "";
	}

	public function getConnection()
	{
		$this->conn = null;

		try {
			$this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

			if ($this->conn->connect_error) {
				throw new Exception("Connection failed: " . $this->conn->connect_error);
			}
		} catch (Exception $e) {
			echo "Database Connection Error: " . $e->getMessage();
		}

		return $this->conn;
	}
}
