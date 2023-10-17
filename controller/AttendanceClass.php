<?php

class AttendanceClass extends BaseClass {

    /**
     * Get the list of attandance based  on filter
     * @param String $string_name Name of the student (Optional)
     * @param String $class_name Name of the class (Optional)
     * 
     * @return List $attendance_list List of attendance
     */
    public function get_attendance($student_name = null, $class_name = null) {
        $query = "SELECT sa.week_number, sa.week_commencing, s.name AS 'student_name', s.email AS 'student_email', monday_status, tuesday_status, wednesday_status, thursday_status, friday_status, sa.weekly_attendance, sa.weekly_absence, c.name AS 'class_name' FROM `student_attendance` AS `sa` 
            LEFT JOIN `student` AS `s` ON sa.student_id = s.id
            LEFT JOIN `class` AS `c` ON sa.class_id = c.id
            WHERE 1=1";
        $where = $student_name ? " AND s.name LIKE '%$student_name%'" : '';
        $where .= $class_name ? " AND c.name LIKE '%$class_name%'" : '';

        $query .= $where;
        try {
            $attendance_list = $this->executeQuery($query);
            return $attendance_list;
        }
        catch(Exception $e){
            print("\n Exception : {$e->getCode()} - {$e->getMessage()}");
            throw new Exception("Query Execution Failed");
        }
        

    }

    /**
     * Insert new entry to the attendance table
     * @param Object $attendance_detail
     * @return Boolean $result
     */
    public function insert_attendance($attendance_detail) {
        try {
            if($attendance_detail->week_number AND $attendance_detail->week_commencing AND $attendance_detail->student_id AND $attendance_detail->monday_status AND $attendance_detail->tuesday_status AND $attendance_detail->wednesday_status AND $attendance_detail->thursday_status AND $attendance_detail->friday_status AND $attendance_detail->class_id) {

                $query = "INSERT INTO `student_attendance` (`week_number`, `week_commencing`, `student_id`, `monday_status`, `tuesday_status`, `wednesday_status`, `thursday_status`, `friday_status`, `class_id`, `created_by`, `updated_by`) VALUES
                ($attendance_detail->week_number, DATE_FORMAT(STR_TO_DATE('$attendance_detail->week_commencing', '%Y-%m-%d'), '%Y-%m-%d %H:%i:%s'), $attendance_detail->student_id, '$attendance_detail->monday_status', '$attendance_detail->tuesday_status', '$attendance_detail->wednesday_status', '$attendance_detail->thursday_status', '$attendance_detail->friday_status', $attendance_detail->class_id, 1, 1)";
            }
            else {
                throw new Exception("All the fields are required!");
            }
        
            $result = $this->executeQuery($query);
            return $result;
        }
        catch(Exception $e){
            print("\n Exception : {$e->getCode()} - {$e->getMessage()}");
            throw new Exception("Query Execution Failed");
        }
    }
}


?>