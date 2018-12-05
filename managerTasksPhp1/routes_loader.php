<?php

class routes_loader {

    var $methods;
    var $user_controller;
    var $project_controller;
    var $customer_controller;
    var $department_controller;
    var $project_worker_controller;
    var $presence_hours_controller;

    public function __construct() {
        $this->user_controller = new user_controller();
        $this->project_controller = new project_controller();
         $this->department_controller = new department_controller();
        $this->project_worker_controller=new projectworker_controller();
        $this->presence_hours_controller=new presentday_controller();

       $this->methods = array(
        'user' => $this->get_users_methods(),
        'project' => $this->get_projects_methods(),
        'department' => $this->get_departments_methods(),
        'projectworker' => $this->get_project_worker_methods(),
	'presenceday'=>$this->get_presence_day_methods()
        );
    }

    function invoke($controller_name, $method_name, $params) {
        $data = $this->methods[$controller_name][$method_name]($params);
        echo json_encode($data);
    }

    function get_users_methods() {
        return array(
            'getAllUsers' => function ($params) {
               // return $this->user_controller->get_all_users($params['managerId']);
            },
            'getAllTeamUsers' => function ($params) {
               // return $this->user_controller->get_all_team_users($params['teamLeaderId']);
            },
            'getAllTeamLeaders' => function ($params) {
              //  return $this->user_controller->get_all_team_leaders($params['managerId']);
            },
            'getUserById' => function ($params) {
               // return $this->user_controller->get_user_by_id($params['userId']);
            }
        );
    }

    function get_projects_methods() {
        return array(
            'getAllProjects' => function ($params) {

               // return $this->project_controller->get_all_projects();
            },
            'getProjectById' => function ($params) {
               // return $this->project_controller->get_project_by_id($params['projectId']);
            },
            'getProjectsByTeamLeaderId' => function ($params) {
               // return $this->project_controller->get_project_by_team_leader_id($params['teamLeaderId']);
            },
            'getProjectsReports' => function () {
               // return $this->project_controller->get_projects_reports();
            }
        );
    }


    function get_departments_methods() {
        return array(
            'getAllDepartments' => function ($params) {

              //  return $this->department_controller->get_all_departments();
            }
        );
    }

    function get_project_worker_methods() {
        return array(
            'getAllWorkerHours' => function ($params) {
              //  return $this->worker_hours_controller->getAllWorkerHours($params['workerId']);
            }
        );
    }

	function get_presence_day_methods() {
        return array(
            'GetPresenceStatusPerWorkers' => function ($params) {

             // return $this->$presence_hours_controller->get_presence_status_per_workers($params['teamLeaderId']);
            }
        );
    }

}
