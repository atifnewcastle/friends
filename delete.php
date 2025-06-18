<?php
// delete.php

// Check if 'id' is set in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Database connection
    require 'dbconn.php';

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM friends WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

// Redirect back to index.php
header("Location: index.php");
exit;
?>