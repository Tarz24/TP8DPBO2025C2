<?php
// controllers/StudentController.php

require_once BASE_PATH . '/models/Student.php';
require_once BASE_PATH . '/models/Course.php';

class StudentController {
    private $student;
    private $course;
    
    public function __construct() {
        $this->student = new Student();
        $this->course = new Course();
    }
    
    // Display all students
    public function index() {
        $students = $this->student->getAll();
        
        // Include view
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/index.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Show create form
    public function create() {
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/create.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Store new student
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            
            if ($this->student->create($name, $nim, $phone, $join_date)) {
                $_SESSION['message'] = "Student created successfully";
            } else {
                $_SESSION['error'] = "Failed to create student";
            }
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/student/index");
        exit();
    }
    
    // Show edit form
    public function edit($id) {
        $student_data = $this->student->getById($id);
        
        if (!$student_data) {
            $_SESSION['error'] = "Student not found";
            header("Location: " . BASE_PATH . "/student/index");
            exit();
        }
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/edit.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Update student
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            
            if ($this->student->update($id, $name, $nim, $phone, $join_date)) {
                $_SESSION['message'] = "Student updated successfully";
            } else {
                $_SESSION['error'] = "Failed to update student";
            }
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/student/index");
        exit();
    }
    
    // Delete student
    public function delete($id) {
        if ($this->student->delete($id)) {
            $_SESSION['message'] = "Student deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete student";
        }
        
        // Redirect to index
        header("Location: " . BASE_PATH . "/student/index");
        exit();
    }
    
    // View student details
    public function view($id) {
        $student_data = $this->student->getById($id);
        
        if (!$student_data) {
            $_SESSION['error'] = "Student not found";
            header("Location: " . BASE_PATH . "/student/index");
            exit();
        }
        
        // Get student's courses
        $courses = $this->student->getCourses($id);
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/view.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // View student's courses
    public function viewCourses($id) {
        $student_data = $this->student->getById($id);
        
        if (!$student_data) {
            $_SESSION['error'] = "Student not found";
            header("Location: " . BASE_PATH . "/student/index");
            exit();
        }
        
        // Get student's courses
        $courses = $this->student->getCourses($id);
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/courses.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Show form to add a course to student
    public function addCourse($id) {
        include 'views/students/add_courses.php';
        $student_data = $this->student->getById($id);
        
        if (!$student_data) {
            $_SESSION['error'] = "Student not found";
            header("Location: " . BASE_PATH . "/student/index");
            exit();
        }
        
        // Get available courses
        $available_courses = $this->student->getAvailableCourses($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_id = $_POST['course_id'];
            $grade = $_POST['grade'] ?? null;
            $enrollment_date = $_POST['enrollment_date'] ?? date('Y-m-d');
            
            if ($this->student->addCourse($id, $course_id, $grade, $enrollment_date)) {
                $_SESSION['message'] = "Course added successfully";
                header("Location: " . BASE_PATH . "/student/courses/{$id}");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add course";
            }
        }
        
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/students/add_courses.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
    
    // Remove a course from student
    public function removeCourse($student_id, $course_id) {
        if ($this->student->removeCourse($student_id, $course_id)) {
            $_SESSION['message'] = "Course removed successfully";
        } else {
            $_SESSION['error'] = "Failed to remove course";
        }
        
        // Redirect to student's courses
        header("Location: " . BASE_PATH . "/student/courses/{$student_id}");
        exit();
    }
}