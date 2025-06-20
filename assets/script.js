$(document).ready(function () {
    let currentStatus = "all";
    // Load tasks based on the current status
    loadTasks(currentStatus);

    // Event listeners for filter buttons
    $(".filter-btn").click(function () {
        let status = $(this).data("status");
        loadTasks(status);
    });

    // Add task form submission
    $("#addTaskForm").submit(function (e) {
        e.preventDefault();
        $.post(
            "api/create_task.php",
            $(this).serialize(),
            function (response) {
                if (response.status === "success") {
                    $("#addTaskForm")[0].reset();
                    loadTasks("all");
                } else {
                    alert("Error adding task.");
                }
            },
            "json"
        );
    });

    // Limit task title input length
    $("#taskTitle, #editTaskTitle").on("input", function () {
        let max = 254;
        if (this.value.length >= max) {
            this.value = this.value.slice(0, max);
        }
    });

    // Edit task functionality
    $(document).on("click", ".edit-btn", function () {
        let id = $(this).data("id");
        let title = $(this).data("title");
        let description = $(this).data("description");
        let status = $(this).data("status");

        $("#editTaskId").val(id);
        $("#editTaskTitle").val(title);
        $("#editTaskDescription").val(description);
        $("#editTaskStatus").val(status);

        var modal = new bootstrap.Modal(
            document.getElementById("editTaskModal")
        );
        modal.show();
    });

    // Edit task form submission
    $("#editTaskForm").submit(function (e) {
        e.preventDefault();
        $.post(
            "api/update_task.php",
            $(this).serialize(),
            function (response) {
                if (response.status === "success") {
                    var modal = bootstrap.Modal.getInstance(
                        document.getElementById("editTaskModal")
                    );
                    modal.hide();
                    loadTasks(currentStatus);
                } else {
                    alert("Error updating task.");
                }
            },
            "json"
        );
    });

    // Delete task functionality
    $(document).on("click", ".delete-btn", function () {
        if (confirm("Are you sure you want to delete this task?")) {
            let id = $(this).data("id");
            $.post(
                "api/delete_task.php",
                { id: id },
                function (response) {
                    loadTasks(currentStatus);
                },
                "json"
            );
        }
    });

    // Toggle task status functionality
    $(document).on("click", ".task-status-toggle", function () {
        let taskData = {
            id: $(this).data("id"),
            title: $(this).data("title"),
            description: $(this).data("description"),
            status: $(this).is(":checked") ? "completed" : "pending",
        };

        $.post(
            "api/update_task.php",
            taskData,
            function (response) {
                if (response.status === "success") {
                    loadTasks(currentStatus);
                } else {
                    alert("Error updating task status.");
                }
            },
            "json"
        );
    });

    // Load tasks based on the current status
    function loadTasks(status) {
        $(".filter-btn").removeClass("active");
        $(`.filter-btn[data-status="${status}"]`).addClass("active");
        currentStatus = status;
        $.getJSON("api/get_tasks.php", { status: status }, function (response) {
            if (response.status === "error") {
                alert(response.message);
            } else {
                let rows = "";
                $.each(response, function (i, task) {
                    rows += `
                <tr>
                    <td>${task.title}</td>
                    <td>${task.description || ""}</td>
					<td>
						<input type="checkbox" class="task-status-toggle"
						data-id="${task.id}"
						data-title="${task.title}"
                        data-description="${task.description || ""}"
						${task.status === "completed" ? "checked" : ""}>
						<label for="status-${task.id}" class="status-label"></label>
					</td>
					<td>${task.created_at}</td>
                    <td>
                        <button class="btn btn-sm btn-info edit-btn"
                            data-id="${task.id}"
                            data-title="${task.title}"
                            data-description="${task.description || ""}"
                            data-status="${task.status}">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${
                            task.id
                        }">Delete</button>
                    </td>
                </tr>`;
                });
                $("#tasksTableBody").html(rows);
            }
        });
    }
});
