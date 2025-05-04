<?php
// Check if there are any flash messages to display
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

// Clear flash messages after displaying them
if (isset($_SESSION['success_message'])) unset($_SESSION['success_message']);
if (isset($_SESSION['error_message'])) unset($_SESSION['error_message']);
?>

<h1>Students List</h1>

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

<div class="row mb-3">
    <div class="col">
        <a href="/student/create" class="btn btn-primary">Add New Student</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIM</th>
                <th>Phone</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($students) && $students->num_rows > 0): ?>
                <?php while ($row = $students->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['nim']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['join_date']); ?></td>
                        <td>
                            <a href="/student/view/<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                            <a href="/student/courses/<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm">Courses</a>
                            <a href="/student/edit/<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <form action="/student/delete" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No students found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>