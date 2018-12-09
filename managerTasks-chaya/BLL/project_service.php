<?php

class project_service extends base_service {

    function get_projects($query) {
        $projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_project($model);
                });

        return $projects;
    }
    
    function get_hours_departments($query) {
        $departments_projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_department_hours($model);
                });
         return $departments_projects;
    }
    
    function get_report_project($query){
           $report_projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_department_hours($model);
                });
         return $report_projects;
    }
            
    

    function get_all_projects() {

        $query = 'SELECT p.*,u.* FROM managertasks.project p join user u on u.id=p.managerId';
        $projects= $this->get_projects($query);
         foreach ($projects as $item) {
            $item['hoursForDepartment']= $this->get_hours_departments_project($item['projectId']);
            $new_projects[]=$item;
        }
        return $new_projects;
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
        $result = db_access::run_non_query($query);
            if ($result->affected_rows > 0) {
                $insert_id = $result->insert_id;
                foreach ($project['hoursForDepartment'] as &$value) {
                     $departmentId=$value['departmentId'];
                     $sumHours=$value['sumHours'];
                     $query = "INSERT INTO `managertasks`.`hourfordepartment`(`projectId`,`departmentId`,`sumHours`)VALUES($insert_id,$departmentId,$sumHours);";
                }
          
            }
         return TRUE;
    }

    function delete_project($projectId) {

        $query = "DELETE FROM `managertasks`.`project`WHERE projectId =$projectId";
        return db_access::run_non_query($query);
    }

    function create_reports_projects($report_name) {
        
    }

    function create_reports_workers($report_name) {
        
    }

    function get_projects_by_teamLeader($teamleader_id)
    {
        $query = "SELECT * FROM managertasks.project WHERE managerId =$teamleader_id";
        $projects= $this->get_projects($query);
        foreach ($projects as $item) {
            $item['hoursForDepartment']= $this->get_hours_departments_project($item['projectId']);
            $new_projects_team[]=$item;
        }

        return $new_projects_team;
    }
    
    function get_hours_departments_project($project_id)
    {
        $query = "SELECT * FROM managertasks.hourfordepartment h JOIN department d ON d.id=h.departmentId WHERE projectId=$project_id;";
        $departments_hours= $this->get_hours_departments($query);
        return $departments_hours;
       // foreach ($departments_hours as $item) {
           // $item['workers']=array();
          //  $item['workers']= $this->get_workers_by_department_and_project($item['departmentId'],$project_id);
       // }
    }
    
    function get_workers_by_department_and_project($department_id,$project_id)
    {
        $query="SELECT * FROM managertasks.sumhoursforuserproject WHERE projectId=$project_id and departmentUserId=$department_id";
    }
    
    function update_project($params)
    {
        $query="UPDATE managertasks.project SET numHour='{$params['numHourForProject']}',name='{$params['projectName']}',dateBegin='{$params['dateBegin']}' ,dateEnd='{$params['dateEnd']}' ,isFinish='{$params['isFinish']}',customerName='{$params['customerName']}'  WHERE projectId={$params['projectId']}";
         $result= db_access::run_non_query($query)->affected_rows;
      if($result>0)
      {
        return http_response_code(204);
        }
      else
      {
        return http_response_code(422);
      }  
    }
}
