<h1>Edit Course</h1>

<div class="card">
    <div class="card-header bg-warning text-white">
        <h5 class="mb-0">Update Course Information</h5>
    </div>
    <div class="card-body">
        <form action="/course/update/<?php echo $course_data['id']; ?>" method="post">
            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $course_data['course_code']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $course_data['course_name']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="credits" name="credits" min="1" max="6" value="<?php echo $course_data['credits']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="number" class="form-control" id="semester" name="semester" min="1" max="8" value="<?php echo $course_data['semester']; ?>" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/course/index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>