<?php
// Check if student data exists
if (!isset($student_data) || empty($student_data)) {
    $_SESSION['error_message'] = "Student not found.";
    header("Location: /student/index");
    exit();
}

// Check for any flash messages
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

// Clear flash messages after displaying them
if (isset($_SESSION['success_message'])) unset($_SESSION['success_message']);
if (isset($_SESSION['error_message'])) unset($_SESSION['error_message']);
?>

<h1>Edit Student</h1>

<?php if ($success_message): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $success_message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if ($error_message): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $error_message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-warning text-white">
        <h5 class="mb-0">Update Student Information</h5>
    </div>
    <div class="card-body">
        <form action="/student/update" method="post">
            <input type="hidden" name="id" value="<?php echo $student_data['id']; ?>">
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($student_data['name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($student_data['nim']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($student_data['phone']); ?>" 
                       pattern="[0-9]+" title="Phone number must contain only digits" required>
            </div>
            
            <div class="mb-3">
                <label for="join_date" class="form-label">Join Date</label>
                <input type="date" class="form-control" id="join_date" name="join_date" value="<?php echo htmlspecialchars($student_data['join_date']); ?>" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/student/view/<?php echo $student_data['id']; ?>" class="btn btn-info">View Details</a>
                <a href="/student/index" class="btn btn-secondary">Back to List</a>
            </div>
        </form>
    </div>
</div>