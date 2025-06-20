<?php

include_once '../Database.class.php';
include_once '../Task.class.php';

try {
	$db = (new Database())->getConnection();
	$task = new Task($db);

	$status = $_GET['status'] ?? 'all';

	$tasks = $task->getAll($status);

	echo json_encode($tasks);
} catch (Exception $e) {
	error_log("Get Tasks API Error: " . $e->getMessage());
	echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve tasks.']);
}