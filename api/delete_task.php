<?php
include_once 'Database.class.php';
include_once 'Task.class.php';

try {
	$db = (new Database())->getConnection();
	$task = new Task($db);

	$id = $_POST['id'] ?? null;

	if (!$id) {
		echo json_encode(['status' => 'error', 'message' => 'Task ID is required']);
		exit;
	}

	if ($task->delete($id)) {
		echo json_encode(['status' => 'success', 'message' => 'Task deleted']);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
	}
} catch (Exception $e) {
	error_log("Delete Task API Error: " . $e->getMessage());
	echo json_encode(['status' => 'error', 'message' => 'An unexpected error occurred while deleting the task.']);
}
