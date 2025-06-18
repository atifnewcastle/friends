<?php
require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['firstname'], $_POST['lastname'], $_POST['age']) &&
        !empty(trim($_POST['firstname'])) &&
        !empty(trim($_POST['lastname'])) &&
        is_numeric($_POST['age'])
    ) {
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $age = (int)$_POST['age'];

        if ($age < 0) {
            die("Invalid input. Please fill all fields correctly.");
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO friends (firstname, lastname, age) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssi", $firstname, $lastname, $age);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New friend added successfully. <a href='index.php'>View friend list</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        die("Invalid input. Please fill all fields correctly.");
    }
}