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

<h1>Add Course for <?php echo htmlspecialchars($student_data['name']); ?></h1>

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
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Course Enrollment</h5>
    </div>
    <div class="card-body">
        <?php if (isset($available_courses) && $available_courses->num_rows > 0): ?>
            <form action="/student/enroll-course" method="post">
                <input type="hidden" name="student_id" value="<?php echo $student_data['id']; ?>">
                
                <div class="mb-3">
                    <label for="course_id" class="form-label">Select Course</label>
                    <select class="form-select" id="course_id" name="course_id" required>
                        <option value="">-- Select Course --</option>
                        <?php while ($row = $available_courses->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['course_code'] . ' - ' . $row['course_name'] . ' (Semester ' . $row['semester'] . ')'); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="grade" class="form-label">Grade (Optional)</label>
                    <select class="form-select" id="grade" name="grade">
                        <option value="">-- No Grade Yet --</option>
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="enrollment_date" class="form-label">Enrollment Date</label>
                    <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Add Course</button>
                    <a href="/student/courses/<?php echo $student_data['id']; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-info">
                <p>No available courses to add. The student is already enrolled in all courses.</p>
            </div>
            <a href="/student/courses/<?php echo $student_data['id']; ?>" class="btn btn-secondary">Back to Courses</a>
        <?php endif; ?>
    </div>
</div>