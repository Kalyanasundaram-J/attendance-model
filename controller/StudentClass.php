<?php
    
    class StudentClass extends BaseClass {

        /**
         * Get all the student details
         * @return List $student_list
         */
        public function get_student_list() {
            $query = "SELECT id, name FROM `student`";
            try{
                $student_list = $this->executeQuery($query);
                return $student_list;
            }
            catch(Exception $e) {
                print("\n Exception : {$e->getCode()} - {$e->getMessage()}");
                throw new Exception("Query Execution Failed");
            }
        }
    }

    $student_object = new StudentClass();
?>