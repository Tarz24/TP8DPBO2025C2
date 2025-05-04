<?php
// controllers/CourseController.php

require_once BASE_PATH . '/models/Course.php';

class CourseController {
    private $course;
    
    public function __construct() {
        $this->course = new Course();
    }
    
    // Display all courses
    public function index() {
        $courses = $this->course->getAll();
        
        // Include view
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/courses/index.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Show create form
    public function create() {
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/courses/create.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Store new course
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_code = $_POST['course_code'];
            $course_name = $_POST['course_name'];
            $credits = $_POST['credits'];
            $semester = $_POST['semester'];
            
            if ($this->course->create($course_code, $course_name, $credits, $semester)) {
                $_SESSION['message'] = "Course created successfully";
            } else {
                $_SESSION['error'] = "Failed to create course";
            }
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/course/index");
        exit();
    }
    
    // Show edit form
    public function edit($id) {
        $course_data = $this->course->getById($id);
        
        if (!$course_data) {
            $_SESSION['error'] = "Course not found";
            header("Location: " . BASE_PATH . "/course/index");
            exit();
        }
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/courses/edit.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Update course
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_code = $_POST['course_code'];
            $course_name = $_POST['course_name'];
            $credits = $_POST['credits'];
            $semester = $_POST['semester'];
            
            if ($this->course->update($id, $course_code, $course_name, $credits, $semester)) {
                $_SESSION['message'] = "Course updated successfully";
            } else {
                $_SESSION['error'] = "Failed to update course";
            }
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/course/index");
        exit();
    }
    
    // Delete course
    public function delete($id) {
        if ($this->course->delete($id)) {
            $_SESSION['message'] = "Course deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete course";
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/course/index");
        exit();
    }
    
    // View course details including enrolled students
    public function view($id) {
        $course_data = $this->course->getById($id);
        
        if (!$course_data) {
            $_SESSION['error'] = "Course not found";
            header("Location: " . BASE_PATH . "/course/index");
            exit();
        }
        
        // Get students enrolled in this course
        $students = $this->course->getStudents($id);
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/courses/view.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
}