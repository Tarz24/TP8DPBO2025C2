<?php
// Check if student data exists
if (!isset($student_data) || empty($student_data)) {
    $_SESSION['error_message'] = "Student not found";
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

<h1><?php echo htmlspecialchars($student_data['name']); ?>'s Details</h1>

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

<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Student Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($student_data['name']); ?></p>
                <p><strong>NIM:</strong> <?php echo htmlspecialchars($student_data['nim']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($student_data['phone']); ?></p>
                <p><strong>Join Date:</strong> <?php echo htmlspecialchars($student_data['join_date']); ?></p>
            </div>
        </div>
        <div class="mt-3">
            <a href="/student/edit/<?php echo $student_data['id']; ?>" class="btn btn-success">Edit</a>
            <a href="/student/courses/<?php echo $student_data['id']; ?>" class="btn btn-primary">View Courses</a>
            <a href="/student/index" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>

<h2>Enrolled Courses</h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Semester</th>
                <th>Grade</th>
                <th>Enrollment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($courses) && $courses->num_rows > 0): ?>
                <?php while ($row = $courses->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['credits']); ?></td>
                        <td><?php echo htmlspecialchars($row['semester']); ?></td>
                        <td><?php echo $row['grade'] ? htmlspecialchars($row['grade']) : '-'; ?></td>
                        <td><?php echo htmlspecialchars($row['enrollment_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No courses enrolled</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="mt-3">
        <a href="/student/add_courses/<?php echo $student_data['id']; ?>" class="btn btn-primary">Add Course</a>
    </div>
</div>