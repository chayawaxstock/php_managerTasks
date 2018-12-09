<?php

class projectworker_controller {

    var $projectworker_service;

    function __construct() {
        $this->projectworker_service=new projectworker_service();
    }

    function get_workers_not_in_project($project_id) {
        return $this->projectworker_service->get_workers_not_in_project($project_id);
    }

    function get_workers_in_project($project_id) {
        return $this->projectworker_service->get_workers_in_project($project_id);
    }
    
      function get_users_teamLeader_project($teamleader_id,$project_id) {
        return $this->projectworker_service->get_users_teamLeader_project($teamleader_id,$project_id);
    }
    function  get_sum_stay_by_project_and_department($project_id)  {
                return $this->projectworker_service->get_sum_stay_by_project_and_department($project_id);

    }
    function  projects_user($user_id)
    {
        return $this->projectworker_service->projects_user($user_id);
    }
    
     function get_users_belong_project($project_id)
     {
         return $this->projectworker_service->get_users_belong_project($project_id);
     }
     
      function get_sum_hours_done_users($project_id,$team_leader_id)
     {
         return $this->projectworker_service->get_sum_hours_done_users($project_id,$team_leader_id);
     }

}
