-- Creating Data Base for attendance
CREATE DATABASE attendance_db;
USE attendance_db;

-- Create student table for store student details
CREATE TABLE `student` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(30) NOT NULL,
	`email` varchar(30) NOT NULL UNIQUE,
	`address` TEXT NOT NULL,
	`mobile` varchar(10) NOT NULL UNIQUE,
	`profile_picture` VARCHAR(255),
	`created_by` INT NOT NULL,
	`created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_by` INT NOT NULL,
	`updated_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

-- Create student attendance table to store attendance details
CREATE TABLE `student_attendance` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`week_number` INT(1) NOT NULL,
	`week_commencing` DATETIME NOT NULL,
	`student_id` INT NOT NULL,
	`monday_status` ENUM('1', 'Sickday', 'Vacation', 'Absent', 'Late'),
	`tuesday_status` ENUM('1', 'Sickday', 'Vacation', 'Absent', 'Late'),
	`wednesday_status` ENUM('1', 'Sickday', 'Vacation', 'Absent', 'Late'),
	`thursday_status` ENUM('1', 'Sickday', 'Vacation', 'Absent', 'Late'),
	`friday_status` ENUM('1', 'Sickday', 'Vacation', 'Absent', 'Late'),
	`weekly_attendance` DECIMAL(3, 1) GENERATED ALWAYS AS (
		(
			CASE
				WHEN monday_status = '1' THEN 1
				WHEN monday_status = 'Late' THEN 0.5
				ELSE 0
			END +
			CASE
				WHEN tuesday_status = '1' THEN 1
				WHEN tuesday_status = 'Late' THEN 0.5
				ELSE 0
			END +
			CASE
				WHEN wednesday_status = '1' THEN 1
				WHEN wednesday_status = 'Late' THEN 0.5
				ELSE 0
			END +
			CASE
				WHEN thursday_status = '1' THEN 1
				WHEN thursday_status = 'Late' THEN 0.5
				ELSE 0
			END +
			CASE
				WHEN friday_status = '1' THEN 1
				WHEN friday_status = 'Late' THEN 0.5
				ELSE 0
			END
    	)
	) STORED,
	`weekly_absence` DECIMAL(3, 1) GENERATED ALWAYS AS (
		(
			CASE
				WHEN monday_status = '1' THEN 0
				WHEN monday_status = 'Late' THEN 0.5
				ELSE 1
			END +
			CASE
				WHEN tuesday_status = '1' THEN 0
				WHEN tuesday_status = 'Late' THEN 0.5
				ELSE 1
			END +
			CASE
				WHEN wednesday_status = '1' THEN 0
				WHEN wednesday_status = 'Late' THEN 0.5
				ELSE 1
			END +
			CASE
				WHEN thursday_status = '1' THEN 0
				WHEN thursday_status = 'Late' THEN 0.5
				ELSE 1
			END +
			CASE
				WHEN friday_status = '1' THEN 0
				WHEN friday_status = 'Late' THEN 0.5
				ELSE 1
			END
		)
	) STORED,
	`class_id` INT NOT NULL,
	`created_by` INT NOT NULL,
	`created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_by` INT NOT NULL,
	`updated_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

-- Class table contain class details
CREATE TABLE `class` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(30) NOT NULL UNIQUE,
	`created_by` INT NOT NULL,
	`created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_by` INT NOT NULL,
	`updated_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

-- Add Foreign key constrain
ALTER TABLE `student_attendance` ADD CONSTRAINT `student_attendance_fk0` FOREIGN KEY (`student_id`) REFERENCES `student`(`id`);

ALTER TABLE `student_attendance` ADD CONSTRAINT `student_attendance_fk1` FOREIGN KEY (`class_id`) REFERENCES `class`(`id`);

ALTER TABLE `student_attendance` ADD CONSTRAINT `student_attendance_fk2` FOREIGN KEY (`created_by`) REFERENCES `student`(`id`);

ALTER TABLE `student_attendance` ADD CONSTRAINT `student_attendance_fk3` FOREIGN KEY (`updated_by`) REFERENCES `student`(`id`);

ALTER TABLE `class` ADD CONSTRAINT `class_fk0` FOREIGN KEY (`created_by`) REFERENCES `student`(`id`);

ALTER TABLE `class` ADD CONSTRAINT `class_fk1` FOREIGN KEY (`updated_by`) REFERENCES `student`(`id`);



