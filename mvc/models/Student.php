<?php
// models/Student.php

require_once BASE_PATH . '/config/database.php';

class Student {
    // Database connection
    private $conn;
    
    // Student properties
    public $id;
    public $name;
    public $nim;
    public $phone;
    public $join_date;
    
    // Constructor
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Get all students
    public function getAll() {
        $sql = "SELECT * FROM students ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // Get single student by ID
    public function getById($id) {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Create new student
    public function create($name, $nim, $phone, $join_date) {
        $sql = "INSERT INTO students (name, nim, phone, join_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $nim, $phone, $join_date);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Update student
    public function update($id, $name, $nim, $phone, $join_date) {
        $sql = "UPDATE students SET name = ?, nim = ?, phone = ?, join_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $nim, $phone, $join_date, $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Delete student
    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Get courses for a student
    public function getCourses($student_id) {
        $sql = "SELECT c.*, sc.grade, sc.enrollment_date 
                FROM courses c 
                JOIN student_courses sc ON c.id = sc.course_id 
                WHERE sc.student_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    // Add course to student
    public function addCourse($student_id, $course_id, $grade = null, $enrollment_date = null) {
        if ($enrollment_date === null) {
            $enrollment_date = date('Y-m-d');
        }
        
        $sql = "INSERT INTO student_courses (student_id, course_id, grade, enrollment_date) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $student_id, $course_id, $grade, $enrollment_date);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Remove course from student
    public function removeCourse($student_id, $course_id) {
        $sql = "DELETE FROM student_courses WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $student_id, $course_id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Get available courses (courses student hasn't enrolled in yet)
    public function getAvailableCourses($student_id) {
        $sql = "SELECT * FROM courses WHERE id NOT IN 
                (SELECT course_id FROM student_courses WHERE student_id = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}