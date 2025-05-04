<?php
// routes.php - Define all application routes

$routes = [
    // Home route
    '/' => ['HomeController', 'index'],
    '/home' => ['HomeController', 'index'],
    
    // Student routes
    '/student/index' => ['StudentController', 'index'],
    '/student/create' => ['StudentController', 'create'],
    '/student/store' => ['StudentController', 'store'],
    '/student/edit/(\d+)' => ['StudentController', 'edit'],
    '/student/update/(\d+)' => ['StudentController', 'update'],
    '/student/delete/(\d+)' => ['StudentController', 'delete'],
    '/student/view/(\d+)' => ['StudentController', 'view'],
    
    // Course routes
    '/course/index' => ['CourseController', 'index'],
    '/course/create' => ['CourseController', 'create'],
    '/course/store' => ['CourseController', 'store'],
    '/course/edit/(\d+)' => ['CourseController', 'edit'],
    '/course/update/(\d+)' => ['CourseController', 'update'],
    '/course/delete/(\d+)' => ['CourseController', 'delete'],
    '/course/view/(\d+)' => ['CourseController', 'view'],
    
    // Student Course relations routes
    '/student/courses/(\d+)' => ['StudentController', 'viewCourses'],
    '/student/add_courses/(\d+)' => ['StudentController', 'addCourse'],
    '/student/remove-course/(\d+)/(\d+)' => ['StudentController', 'removeCourse'],
];
