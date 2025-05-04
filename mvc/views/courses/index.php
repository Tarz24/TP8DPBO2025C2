<h1>Courses List</h1>

<div class="row mb-3">
    <div class="col">
        <a href="/course/create" class="btn btn-primary">Add New Course</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Semester</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($courses->num_rows > 0): ?>
                <?php while ($row = $courses->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['course_code']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['credits']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td>
                            <a href="/course/view/<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                            <a href="/course/edit/<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="/course/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No courses found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>