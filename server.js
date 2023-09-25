const express = require("express");
const bodyParser = require("body-parser");
const sqlite3 = require("sqlite3").verbose();

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(express.static("public"));

// Create or open the SQLite database
const db = new sqlite3.Database("db.sqlite");

// Create a table for tasks if it doesn't exist
db.serialize(() => {
    db.run("CREATE TABLE IF NOT EXISTS todos (id INTEGER PRIMARY KEY AUTOINCREMENT, todos TEXT, status INTEGER DEFAULT 0)");
});

// Endpoint to add a task
app.post("/addTask", (req, res) => {
    const { task } = req.body;

    if (!task) {
        return res.status(400).json({ error: "Please enter a proper task." });
    }

    const stmt = db.prepare("INSERT INTO todos (todos, status) VALUES (?, ?)");
    stmt.run(task, 0, function(err) {
        if (err) {
            return res.status(500).json({ error: "Error adding task." });
        }

        res.sendStatus(200);
    });
    stmt.finalize();
});

// Endpoint to get tasks
app.get("/getTasks", (req, res) => {
    db.all("SELECT * FROM todos", (err, rows) => {
        if (err) {
            return res.status(500).json({ error: "Error retrieving tasks." });
        }

        res.json(rows);
    });
});

// Endpoint to delete a task
app.post("/deleteTask", (req, res) => {
    const { taskId } = req.body;

    db.run("DELETE FROM todos WHERE id = ?", taskId, function(err) {
        if (err) {
            return res.status(500).json({ error: "Error deleting task." });
        }

        res.sendStatus(200);
    });
});

// Endpoint to mark a task as done
app.post("/markTaskAsDone", (req, res) => {
    const { taskId } = req.body;

    db.run("UPDATE todos SET status = 1 WHERE id = ?", taskId, function(err) {
        if (err) {
            return res.status(500).json({ error: "Error marking task as done." });
        }

        res.sendStatus(200);
    });
});

// Endpoint to fetch a motivational quote (replace with your own API or data source)
app.get("/motivationalQuotes", (req, res) => {
    const quotes = [
        "Motivational Quote 1",
        "Motivational Quote 2",
        "Motivational Quote 3",
    ];

    const randomIndex = Math.floor(Math.random() * quotes.length);
    res.send(quotes[randomIndex]);
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
