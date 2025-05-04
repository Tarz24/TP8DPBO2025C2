-- Database: tp_mvc
CREATE DATABASE IF NOT EXISTS tp_mvc;
USE tp_mvc;

-- Tabel siswa (yang sudah ada, mungkin perlu dimodifikasi)
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  nim VARCHAR(20) NOT NULL UNIQUE,
  phone VARCHAR(15),
  join_date DATE
);

-- Tabel baru: courses (mata kuliah)
CREATE TABLE IF NOT EXISTS courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_code VARCHAR(10) NOT NULL UNIQUE,
  course_name VARCHAR(100) NOT NULL,
  credits INT NOT NULL,
  semester INT NOT NULL
);

-- Tabel relasi: student_courses (untuk menghubungkan mahasiswa dengan mata kuliah)
CREATE TABLE IF NOT EXISTS student_courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  course_id INT NOT NULL,
  grade VARCHAR(2),
  enrollment_date DATE,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
  UNIQUE KEY (student_id, course_id) -- Mencegah pendaftaran duplikat
);

-- Mengisi data awal untuk testing
INSERT INTO students (name, nim, phone, join_date) VALUES
('John Doe', '2020010001', '081234567890', '2020-09-01'),
('Jane Smith', '2020010002', '081234567891', '2020-09-01'),
('Bob Johnson', '2020010003', '081234567892', '2020-09-02');

INSERT INTO courses (course_code, course_name, credits, semester) VALUES
('CS101', 'Introduction to Programming', 3, 1),
('CS201', 'Data Structures', 4, 2),
('CS301', 'Database Systems', 3, 3);

INSERT INTO student_courses (student_id, course_id, grade, enrollment_date) VALUES
(1, 1, 'A', '2020-09-10'),
(1, 2, 'B+', '2021-02-15'),
(2, 1, 'A-', '2020-09-10'),
(3, 3, 'B', '2021-09-12');