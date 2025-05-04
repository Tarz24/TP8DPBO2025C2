<?php
// controllers/HomeController.php

require_once BASE_PATH . '/models/Student.php';
require_once BASE_PATH . '/models/Course.php';

class HomeController {
    private $student;
    private $course;
    
    public function __construct() {
        $this->student = new Student();
        $this->course = new Course();
    }
    
    // Display homepage
    public function index() {
        // Get stats for dashboard
        $students = $this->student->getAll();
        $student_count = $students->num_rows;
        
        $courses = $this->course->getAll();
        $course_count = $courses->num_rows;
        
        // Get latest students
        $latest_students = [];
        $counter = 0;
        while ($row = $students->fetch_assoc()) {
            if ($counter < 5) {
                $latest_students[] = $row;
                $counter++;
            } else {
                break;
            }
        }
        
        // Get latest courses
        $latest_courses = [];
        $counter = 0;
        while ($row = $courses->fetch_assoc()) {
            if ($counter < 5) {
                $latest_courses[] = $row;
                $counter++;
            } else {
                break;
            }
        }
        
        // Include view
        require_once BASE_PATH . '/views/templates/header.php';
        require_once BASE_PATH . '/views/home/index.php';
        require_once BASE_PATH . '/views/templates/footer.php';
    }
}