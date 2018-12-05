<?php

class project_service extends base_service {
    
     function get_projects($query) {
        $projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_project($model);
                });
           return $projects;
    }

    function get_all_projects() {
  
        $query ='SELECT p.*,u.* FROM managertasks.project p join user u on u.id=p.managerId';
        return $this->get_projects($query);
    }
    
    function create_reports_projects($report_name){
        
    }
    function  create_reports_workers($report_name)
    {
        
    }


//            function get_all_department($manager_id) {
//       $query ='SELECT * FROM user u JOIN department d ON u.departmentUserId=d.id LEFT JOIN user uu ON u.managerId=uu.id';
//        return $this->get_users($query);
//    }
    
}