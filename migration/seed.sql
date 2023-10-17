-- Add seed data for testing

-- Insert Student Details seed data
INSERT INTO `student` (`name`, `email`, `address`, `mobile`, `profile_picture`, `created_by`, `updated_by`) VALUES
('student1', 'student1@gmail.com', 'student1 address', '1023584785', 'https://google.com', 1, 1),
('student2', 'student2@gmail.com', 'student2 address', '2023584785', 'https://example.com', 2, 2),
('student3', 'student3@gmail.com', 'student3 address', '3023584785', 'https://dummyimage.com', 3, 3),
('student4', 'student4@gmail.com', 'student4 address', '4023584785', 'https://placeholder.com', 4, 4);


-- Insert Class Details to Class Table
INSERT INTO `class` (`name`, `created_by`, `updated_by`) VALUES
('Nervous system', 1, 1),
('First Aid', 1, 1),
('Pathology Class 2', 1, 1),
('Cell Biology', 1, 1),
('Genetics', 1, 1),
('Microbiology', 1, 1),
('Anatomy and Physiology', 1, 1),
('Immunology', 1, 1),
('Ecology', 1, 1),
('Evolutionary Biology', 1, 1);

-- Insert attendance details to student_attendance table

INSERT INTO `student_attendance` (`week_number`, `week_commencing`, `student_id`, `monday_status`, `tuesday_status`, `wednesday_status`, `thursday_status`, `friday_status`, `class_id`, `created_by`, `updated_by`) VALUES
(1, '2023-10-16 15:32:16', 2, '1', 'Late', '1', 'Late', 'Absent', 4, 1, 1),
(2, '2023-10-23 15:32:16', 1, '1', 'Late', '1', 'Late', 'Absent', 1, 1, 1),
(3, '2023-10-30 15:32:16', 3, '1', 'Late', '1', 'Late', 'Absent', 2, 1, 1),
(4, '2023-11-01 15:32:16', 2, '1', 'Absent', '1', '1', '1', 3, 1, 1),
(1, '2023-11-08 15:32:16', 4, '1', '1', '1', '1', '1', 4, 1, 1),
(2, '2023-11-16 15:32:16', 1, 'Late', 'Late', 'Late', 'Late', 'Late', 5, 1, 1);