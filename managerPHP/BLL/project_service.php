<?php

class project_service extends base_service {

    function get_projects($query) {
        $projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_project($model);
                });

        return $projects;
    }

    function get_all_projects() {

        $query = 'SELECT p.*,u.* FROM managertasks.project p join user u on u.id=p.managerId';
        return $this->get_projects($query);
    }

    function add_project($project) {
        print_r($project);
        $format = 'Y-m-d';
        $dateBegin = date($format);
        print_r($dateBegin);
//        format_date($project['dateBegin'], $format) ;
        $dateEnd = $project['dateEnd'];
        $IsFinish = ($project['isFinish'] ? 1 : 0);
        $numHour = $project['numHourForProject'];
        $name = $project['projectName'];
        $customerName = $project['customerName'];
        $managerId = $project['idManager'];
//        start transaction;
        $query = " INSERT INTO `managertasks`.`project`(`numHour`,`name`,`dateBegin`,`dateEnd`,`isFinish`,`customerName`,`managerId`) VALUES('$numHour','$name','$dateBegin','$dateEnd',$IsFinish,'$customerName',$managerId); ";
//
//        foreach ($project['hoursForDepartment'] as &$value) {
//            $departmentId=$value['departmentId'];
//            $sumHours=$value['sumHours'];
//            $query += "SET @EE=0;SELECT MAX(projectId) FROM project INTO @EE; INSERT INTO `managertasks`.`hourfordepartment`(`projectId`,`departmentId`,`sumHours`)VALUES('@EE',$departmentId,$sumHours);";
//        }
//          $query += "commit;";
        return db_access::run_non_query($query);
    }

    function delete_project($projectId) {

        $query = "DELETE FROM `managertasks`.`project`WHERE projectId =$projectId";
        return db_access::run_non_query($query);
    }

    function create_reports_projects($report_name) {
        
    }

    function create_reports_workers($report_name) {
        
    }

//            function get_all_department($manager_id) {
//       $query ='SELECT * FROM user u JOIN department d ON u.departmentUserId=d.id LEFT JOIN user uu ON u.managerId=uu.id';
//        return $this->get_users($query);
//    }
}
