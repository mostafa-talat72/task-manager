<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Task Manager</title>
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Styles -->
	<link rel="stylesheet" href="assets/style.css">

</head>

<body class="bg-light">

	<div class="container py-5">
		<h1 class="mb-4">Task Manager</h1>

		<!-- Add Task Form -->
		<div class="card mb-4">
			<div class="card-header">Add New Task</div>
			<div class="card-body">
				<form id="addTaskForm">
					<div class="mb-3">
						<label class="form-label">Title *</label>
						<input type="text" name="title" class="form-control" required maxlength="254">
					</div>
					<div class="mb-3">
						<label class="form-label">Description</label>
						<textarea name="description" class="form-control"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Add Task</button>
				</form>
			</div>
		</div>

		<!-- Filter Buttons -->
		<div class="mb-3">
			<button class="btn btn-outline-dark filter-btn" data-status="all">All</button>
			<button class="btn btn-outline-dark filter-btn" data-status="pending">Pending</button>
			<button class="btn btn-outline-dark filter-btn" data-status="completed">Completed</button>
		</div>

		<!-- Tasks Table -->
		<div class="card">
			<div class="card-header">Tasks</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="tasksTableBody">
						<!-- Tasks will be inserted here by ajax-->
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Edit Task Modal -->
	<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<form id="editTaskForm" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Task</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="editTaskId">
					<div class="mb-3">
						<label class="form-label">Title *</label>
						<input type="text" name="title" id="editTaskTitle" class="form-control" required
							maxlength="254">
					</div>
					<div class="mb-3">
						<label class="form-label">Description</label>
						<textarea name="description" id="editTaskDescription" class="form-control"></textarea>
					</div>
					<div class="mb-3">
						<label class="form-label">Status</label>
						<select name="status" id="editTaskStatus" class="form-select">
							<option value="pending">Pending</option>
							<option value="completed">Completed</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Update Task</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Main Script -->
	<script src="assets/script.js"></script>

</body>

</html>
