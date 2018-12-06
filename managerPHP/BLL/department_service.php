<?php

class department_service extends base_service {
    
     function get_departments($query) {
        $departments = db_access:: run_reader($query, function ($model) {
                    return $this->init_department($model);
                });
           return $departments;
    }
    
    //good
    function get_all_department()
    {
         $query ='SELECT * FROM user u JOIN department d ON u.departmentUserId=d.id LEFT JOIN user uu ON u.managerId=uu.id';
         return $this->get_departments($query);
    }
}
