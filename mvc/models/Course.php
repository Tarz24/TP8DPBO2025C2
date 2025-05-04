<?php
// models/Course.php

require_once BASE_PATH . '/config/database.php';

class Course {
    // Database connection
    private $conn;
    
    // Course properties
    public $id;
    public $course_code;
    public $course_name;
    public $credits;
    public $semester;
    
    // Constructor
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Get all courses
    public function getAll() {
        $sql = "SELECT * FROM courses ORDER BY semester ASC, course_code ASC";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // Get single course by ID
    public function getById($id) {
        $sql = "SELECT * FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Create new course
    public function create($course_code, $course_name, $credits, $semester) {
        $sql = "INSERT INTO courses (course_code, course_name, credits, semester) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $course_code, $course_name, $credits, $semester);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Update course
    public function update($id, $course_code, $course_name, $credits, $semester) {
        $sql = "UPDATE courses SET course_code = ?, course_name = ?, credits = ?, semester = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiii", $course_code, $course_name, $credits, $semester, $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Delete course
    public function delete($id) {
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Get students enrolled in a course
    public function getStudents($course_id) {
        $sql = "SELECT s.*, sc.grade, sc.enrollment_date 
                FROM students s 
                JOIN student_courses sc ON s.id = sc.student_id 
                WHERE sc.course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}