const express = require("express");
const bodyParser = require("body-parser");
const mysql = require("mysql");

const app = express();
const port = process.env.PORT || 3000;

app.use(express.static("public"));
app.use(bodyParser.urlencoded({ extended: true }));

// Create a MySQL connection
const db = mysql.createConnection({
    host: "localhost",       // Replace with your MySQL host
    user: "sergeygruzdov",   // Replace with your MySQL username
    password: "p7^643dUt",   // Replace with your MySQL password
    database: "todoapp",     // Replace with your MySQL database name
});

// Connect to MySQL
db.connect((err) => {
    if (err) {
        console.error("Error connecting to MySQL:", err);
    } else {
        console.log("Connected to MySQL");
    }
});

// API endpoint to get tasks from the database
app.get("/tasks", (req, res) => {
    const sql = "SELECT * FROM tasks";
    db.query(sql, (err, tasks) => {
        if (err) {
            console.error("Error fetching tasks:", err);
            res.status(500).send("Error fetching tasks");
        } else {
            res.json(tasks);
        }
    });
});

// API endpoint to add a task to the database
app.post("/tasks", (req, res) => {
    const { text } = req.body;
    const sql = "INSERT INTO tasks (text) VALUES (?)";
    db.query(sql, [text], (err, result) => {
        if (err) {
            console.error("Error adding task:", err);
            res.status(500).send("Error adding task");
        } else {
            res.json({ id: result.insertId, text });
        }
    });
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
