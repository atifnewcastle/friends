<?php
require_once 'dbconn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get friend ID from query string
$id = isset($_GET['id']) ? intval(value: $_GET['id']) : 0;

// Fetch friend data
$friend = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT firstname, lastname, age FROM friends WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname, $age);
    if ($stmt->fetch()) {
        $friend = ['firstname' => $firstname, 'lastname' => $lastname, 'age' => $age];
    }
    $stmt->close();
} else {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $age = intval($_POST['age']);

    $stmt = $conn->prepare("UPDATE friends SET firstname=?, lastname=?, age=? WHERE id=?");
    $stmt->bind_param("ssii", $firstname, $lastname, $age, $id);
    if ($stmt->execute()) {
        echo "<p>Friend updated successfully. <a href='index.php'>Back to list</a></p>";
    } else {
        echo "<p>Error updating friend.</p>";
    }
    $stmt->close();
    $conn->close();
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Friend</title>
</head>
<head>
    <title>Update Friend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Update Friend</h2>
        <?php if ($friend): ?>
        <form method="post" class="card p-4 shadow-sm" style="max-width: 500px;">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($friend['firstname']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($friend['lastname']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" value="<?php echo htmlspecialchars($friend['age']); ?>" min="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Friend not found.</div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>