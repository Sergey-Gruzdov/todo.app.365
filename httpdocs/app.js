document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("taskInput");
    const addTaskButton = document.getElementById("addTask");
    const taskList = document.getElementById("taskList");

    // Function to add a new task
    function addTask() {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            const li = document.createElement("li");
            li.innerHTML = `
                <span>${taskText}</span>
                <button class="delete">Delete</button>
            `;
            taskList.appendChild(li);
            taskInput.value = "";
            attachDeleteListener(li);
        }
    }

    // Function to attach delete listener to a task
    function attachDeleteListener(li) {
        const deleteButton = li.querySelector(".delete");
        deleteButton.addEventListener("click", function () {
            taskList.removeChild(li);
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
});
