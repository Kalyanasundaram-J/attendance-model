<?php
    
    class ClassClass extends BaseClass {

        /**
         * Get all the class from Class table
         * @return List $class_list
         */
        public function get_class_list() {
            $query = "SELECT id, name FROM `class`";
            try{
                $class_list = $this->executeQuery($query);
                return $class_list;
            }
            catch(Exception $e) {
                print("\n Exception : {$e->getCode()} - {$e->getMessage()}");
                throw new Exception("Query Execution Failed");
            }
        }
    }

    $class_object = new ClassClass();
?>