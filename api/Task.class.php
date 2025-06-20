<?php
class Task
{
	private $conn;
	private $table;

	public function __construct($db)
	{
		$this->conn = $db;
		$this->table = "tasks";
	}

	// This function creates a new task in the database.
	public function create($title, $description)
	{
		try {
			$stmt = $this->conn->prepare("INSERT INTO $this->table (title, description) VALUES (?, ?)");
			$stmt->bind_param("ss", $title, $description);
			return $stmt->execute();
		} catch (Exception $e) {
			error_log("Create Task Error: " . $e->getMessage());
			return false;
		}
	}

	// This function retrieves all tasks from the database, optionally filtered by status.
	public function getAll($status)
	{
		try {
			$query = "SELECT * FROM $this->table";
			if ($status == "pending" || $status == "completed") {
				$query .= " WHERE status='$status'";
			}
			$query .= " ORDER BY created_at DESC";
			$result = $this->conn->query($query);
			$tasks = [];
			while ($row = $result->fetch_assoc()) {
				$tasks[] = $row;
			}
			return $tasks;
		} catch (Exception $e) {
			error_log("Get Tasks Error: " . $e->getMessage());
			return [];
		}
	}

	// This function retrieves a single task by its ID.
	public function update($id, $title, $description, $status)
	{
		try {
			$stmt = $this->conn->prepare("UPDATE $this->table SET title=?, description=?, status=? WHERE id=?");
			$stmt->bind_param("sssi", $title, $description, $status, $id);
			return $stmt->execute();
		} catch (Exception $e) {
			error_log("Update Task Error: " . $e->getMessage());
			return false;
		}
	}

	// This function deletes a task by its ID.
	public function delete($id)
	{
		try {
			$stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
			$stmt->bind_param("i", $id);
			return $stmt->execute();
		} catch (Exception $e) {
			error_log("Delete Task Error: " . $e->getMessage());
			return false;
		}
	}
}
