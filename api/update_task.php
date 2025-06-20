<?php
include_once 'Database.class.php';
include_once 'Task.class.php';

try {
	$db = (new Database())->getConnection();
	$task = new Task($db);

	$id = $_POST['id'] ?? null;
	$title = htmlspecialchars(trim($_POST['title'] ?? ''));
	$description = htmlspecialchars(trim($_POST['description'] ?? ''));
	$status = $_POST['status'] ?? 'pending';

	if (!$id || empty($title)) {
		echo json_encode(['status' => 'error', 'message' => 'ID and Title are required']);
		exit;
	}

	if ($task->update($id, $title, $description, $status)) {
		echo json_encode(['status' => 'success', 'message' => 'Task updated']);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Update failed']);
	}
} catch (Exception $e) {
	error_log("Update Task API Error: " . $e->getMessage());
	echo json_encode(['status' => 'error', 'message' => 'An unexpected error occurred.']);
}
