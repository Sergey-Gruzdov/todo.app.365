document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("taskInput");
    const addTaskButton = document.getElementById("addTask");
    const taskList = document.getElementById("taskList");

    // Function to fetch tasks from the server
    function fetchTasks() {
        fetch("/tasks")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((task) => {
                    addTaskToList(task);
                });
            });
    }

    // Function to add a new task to the server and list
    function addTask() {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            fetch("/tasks", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `text=${encodeURIComponent(taskText)}`,
            })
                .then((response) => response.json())
                .then((task) => {
                    addTaskToList(task);
                    taskInput.value = "";
                });
        }
    }

    // Function to add a task to the list
    function addTaskToList(task) {
        const li = document.createElement("li");
        li.innerHTML = `
            <span>${task.text}</span>
            <button class="delete" data-task-id="${task._id}">Delete</button>
        `;
        taskList.appendChild(li);
        attachDeleteListener(li);
    }

    // Function to delete a task
    function deleteTask(taskId) {
        fetch(`/tasks/${taskId}`, { method: "DELETE" })
            .then(() => {
                const taskElement = document.querySelector(`[data-task-id="${taskId}"]`);
                if (taskElement) {
                    taskElement.parentElement.removeChild(taskElement);
                }
            });
    }

    // Function to attach delete listener to a task
    function attachDeleteListener(li) {
        const deleteButton = li.querySelector(".delete");
        const taskId = deleteButton.getAttribute("data-task-id");
        deleteButton.addEventListener("click", () => {
            deleteTask(taskId);
        });
    }

    // Event listener for adding a task
    addTaskButton.addEventListener("click", addTask);

    // Event listener for adding a task on Enter key press
    taskInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            addTask();
        }
    });

    // Fetch tasks when the page loads
    fetchTasks();
});
