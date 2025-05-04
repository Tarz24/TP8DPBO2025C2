<div class="jumbotron bg-light p-5 rounded-lg mb-4">
    <h1 class="display-4">Welcome to Student Management System</h1>
    <p class="lead">A powerful MVC application for managing students and course enrollments</p>
    <hr class="my-4">
    <p>This system allows you to manage students, courses, and their relationships. Navigate through the menus to access different functionalities.</p>
    <div class="mt-4">
        <a class="btn btn-primary btn-lg" href="/student/index" role="button">View Students</a>
        <a class="btn btn-success btn-lg mx-2" href="/course/index" role="button">View Courses</a>
    </div>
</div>

<div class="row dashboard-summary">
    <div class="col-md-6 mb-4">
        <div class="card bg-primary text-white summary-card">
            <div class="card-body">
                <h5 class="card-title">Total Students</h5>
                <h2 class="display-4"><?= $student_count ?></h2>
                <p class="card-text">Registered students in the system</p>
                <a href="/student/index" class="btn btn-light">Manage Students</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card bg-success text-white summary-card">
            <div class="card-body">
                <h5 class="card-title">Total Courses</h5>
                <h2 class="display-4"><?= $course_count ?></h2>
                <p class="card-text">Available courses in the system</p>
                <a href="/course/index" class="btn btn-light">Manage Courses</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Latest Students</h5>
            </div>
            <div class="card-body">
                <?php if (count($latest_students) > 0): ?>
                    <div class="list-group">
                        <?php foreach ($latest_students as $student): ?>
                            <a href="/student/view/<?= $student['id'] ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $student['name'] ?></h5>
                                    <small>NIM: <?= $student['nim'] ?></small>
                                </div>
                                <p class="mb-1">Phone: <?= $student['phone'] ?></p>
                                <small>Joined: <?= $student['join_date'] ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center">No students found</p>
                <?php endif; ?>
                <div class="mt-3">
                    <a href="/student/index" class="btn btn-primary">View All Students</a>
                    <a href="/student/create" class="btn btn-success">Add New Student</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Latest Courses</h5>
            </div>
            <div class="card-body">
                <?php if (count($latest_courses) > 0): ?>
                    <div class="list-group">
                        <?php foreach ($latest_courses as $course): ?>
                            <a href="/course/view/<?= $course['id'] ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $course['course_name'] ?></h5>
                                    <small>Code: <?= $course['course_code'] ?></small>
                                </div>
                                <p class="mb-1">Credits: <?= $course['credits'] ?></p>
                                <small>Semester: <?= $course['semester'] ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center">No courses found</p>
                <?php endif; ?>
                <div class="mt-3">
                    <a href="/course/index" class="btn btn-primary">View All Courses</a>
                    <a href="/course/create" class="btn btn-success">Add New Course</a>
                </div>
            </div>
        </div>
    </div>
</div>