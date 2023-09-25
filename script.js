document.addEventListener("DOMContentLoaded", () => {
    const taskForm = document.getElementById("taskForm");
    const taskInput = document.getElementById("task");
    const addTaskButton = document.getElementById("addTask");
    const tasksList = document.getElementById("tasks-list");

    // Add task event listener
    addTaskButton.addEventListener("click", () => {
        const task = taskInput.value.trim();
        if (task === "") {
            alert("Please enter a proper task.");
            return;
        }

        // Send a POST request to the server to add the task
        fetch("/addTask", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ task }),
        })
        .then(() => {
            taskInput.value = "";
            displayTasks();
        })
        .catch(error => {
            console.error("Error adding task:", error);
        });
    });

    // Function to display tasks
    function displayTasks() {
        // Send a GET request to the server to get the tasks
        fetch("/getTasks")
        .then(response => response.json())
        .then(data => {
            tasksList.innerHTML = "";

            data.forEach(task => {
                const taskRow = document.createElement("tr");
                taskRow.innerHTML = `
                    <td>${task.id}</td>
                    <td>${task.todos}</td>
                    <td>
                        <button onclick="deleteTask(${task.id})">Delete</button>
                        <button onclick="markTaskAsDone(${task.id})">Done</button>
                    </td>
                `;
                tasksList.appendChild(taskRow);
            });
        })
        .catch(error => {
            console.error("Error retrieving tasks:", error);
        });
    }

    // Function to delete a task
    function deleteTask(taskId) {
        // Send a POST request to the server to delete the task
        fetch("/deleteTask", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ taskId }),
        })
        .then(displayTasks)
        .catch(error => {
            console.error("Error deleting task:", error);
        });
    }

    // Function to mark a task as done
    function markTaskAsDone(taskId) {
        // Send a POST request to the server to mark the task as done
        fetch("/markTaskAsDone", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ taskId }),
        })
        .then(displayTasks)
        .catch(error => {
            console.error("Error marking task as done:", error);
        });
    }

    // Initialize the tasks list
    displayTasks();

    // Fetch and display a motivational quote (you can replace this URL)
    fetch("/motivationalQuotes") // Replace with the actual URL to fetch quotes
        .then(response => response.text())
        .then(data => {
            document.getElementById("motivational-quote").textContent = "Motivational Quote: " + data;
        })
        .catch(error => {
            console.error("Error fetching motivational quote:", error);
        });
});
