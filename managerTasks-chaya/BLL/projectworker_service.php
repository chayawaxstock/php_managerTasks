<?php

class projectworker_service extends base_service {
    
     function get_projectworkers($query) {
        $projectworkers = db_access:: run_reader($query, function ($model) {
                    return $this->init_projectworker($model);
                });
           return $projectworkers;
    }
    
      function get_workers_projects($query) {
        $workers_projects = db_access:: run_reader($query, function ($model) {
                    return $this->init_worker_project($model);
                });
        return $workers_projects;
    }
    
     function get_users($query) {
        $users = db_access:: run_reader($query, function ($model) {
                    return $this->init_user($model);
                });
           return $users;
    }

    function get_workers_not_in_project($project_id)
    {
        $query="SELECT * FROM managertasks.user WHERE departmentUserId>2 and id not in(SELECT id FROM projectworker WHERE projectId=$project_id) GROUP BY id";
        return $this->get_users($query);
    }
    
    function  get_workers_in_project($project_id)
    {
        $query="SELECT u.*, d.id as department_id,d.department FROM managertasks.user u JOIN managertasks.department d  ON u.departmentUserId = d.id join projectworker p on u.id = p.id where p.projectId = $project_id ";
            return $this->get_users($query);
    }
    
    function  get_users_teamLeader_project($teamleader_id,$project_id)
    {
        $query="SELECT sum(pd.sumHours),u.userName  FROM user u JOIN projectworker pw ON pw.id = u.id LEFT JOIN presentday pd ON pd.id = u.id WHERE u.managerId = $teamleader_id AND pw.projectId = $project_id AND pd.projectId = $project_id GROUP BY pw.projectId ,pw.id ";
         return $this->get_projectworkers($query);
    }
    
    function  get_sum_stay_by_project_and_department($project_id)
    {
        $query="SELECT h.sumHours-sum(pw.hoursForProject) from project p join hourfordepartment h on p.projectId = h.projectId join projectworker pw on pw.projectId = p.projectId where p.projectId = $project_id group by h.departmentId";
          return $this->get_projectworkers($query);
    }
    
      function projects_user($user_id) {
        $query = "SELECT *,(select sum(sumHours) from presentday pd where pd.id=pw.id and pd.projectId=p.projectId group by id) as sumHoursDone FROM managertasks.projectworker pw join project p on  pw.projectId = p.projectId where pw.id = $user_id and p.isFinish=false ";
        return $this->get_workers_projects($query);
    }
    
    function get_users_belong_project($project_id)
    {
        $query="SELECT * FROM project p JOIN projectworker pw ON  p.projectId =pw.projectId JOIN user u ON pw.id =u.id WHERE pw.projectId={projectId} AND pw.isActive=true";
        return $this->get_workers_projects($query);
    }
    
     function get_sum_hours_done_users($project_id,$team_leader_id)
    {
        $query="SELECT sum(sumHours),u.userName FROM presentday p JOIN user u on u.id= p.id WHERE u.managerId =$team_leader_id AND projectId=$project_id GROUP BY u.id";
        return db_access::run_reader($query, function ($model) {
                    return $model;
                });
    }

}
