<?php
include_once '../classes/Database.class.php';
include_once '../classes/Task.class.php';

try {
	$db = (new Database())->getConnection();
	$task = new Task($db);

	$title = htmlspecialchars(trim($_POST['title'] ?? ''));
	$description = htmlspecialchars(trim($_POST['description'] ?? ''));

	if (empty($title)) {
		echo json_encode(['status' => 'error', 'message' => 'Title is required']);
		exit;
	}

	if ($task->create($title, $description)) {
		echo json_encode(['status' => 'success', 'message' => 'Task created']);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Failed to create task.']);
	}
} catch (Exception $e) {
	error_log("Create Task API Error: " . $e->getMessage());
	echo json_encode(['status' => 'error', 'message' => 'An unexpected error occurred while creating the task.']);
}
