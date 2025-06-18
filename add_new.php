<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Friend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Add New Friend</h2>
    <form action="insert.php" method="post">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" pattern="[A-Za-z\s]+" title="First name must contain letters and spaces only" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" pattern="[A-Za-z\s]+" title="Last name must contain letters and spaces only" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Friend</button>
    </form>
</div>
</body>
</html>