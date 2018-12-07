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
        $this->presence_hours_controller=new presenceday_controller();

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
                return $this->user_controller->get_all_users();
            },
            'forgetPassword' => function ($params) {
                return $this->user_controller->forgot_password($params['userName']);
            },
            'getHoursForUserProjects' => function ($params) {
               return $this->user_controller->hours_user_done_projects($params['userId']);
            },
	    'getProjectsByUserId' => function ($params) {
	    return $this->user_controller->projects_user($params['userId']);
	    },
            'getUserById' => function ($params) {
               // return $this->user_controller->get_user_by_id($params['userId']);
            },
             'loginByPassword' => function ($params) {
                return $this->user_controller->login_by_password($params['password'],$params['userName']);
            },
	    'addUser' => function ($params) {
	    return $this->user_controller->add_user($params);
	    },
	    
            'loginByIp' => function ($params) {
                return $this->user_controller->login_by_ip($params["ip"]);
            }
        );
    }

    function get_projects_methods() {
        return array(
            'getAllProjects' => function ($params) {

                return $this->project_controller->getAllProjects();
            },
            'addProject' => function ($params) {

                return $this->project_controller->add_project($params);
            },
            'deleteProject' => function ($params) {
                echo $params['projectId'];
                return $this->project_controller->delete_project($params['projectId']);
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
              return $this->department_controller->get_all_departments();
            }
        );
    }

    function get_project_worker_methods() {
        return array(
            'getWorkersNotInProject' => function ($params) {
                return $this->project_worker_controller->get_workers_not_in_project($params['projectId']);
            },
            'getWorkersInProject' => function ($params) {
                return $this->project_worker_controller->get_workers_in_project($params['projectId']);
            },
            'getUsersTeamLeaderProject' => function ($params) {

                return $this->project_worker_controller->get_users_teamLeader_project($params['teamleaderId'], $params['projectId']);
            },
            'getSumStayByProjectAndDepartment' => function ($params) {
                return $this->project_worker_controller->get_sum_stay_by_project_and_department($params['projectId']);
            }
        );
    }

	function get_presence_day_methods() {
        return array(
            'updatePresenceDayWorker' => function ($params) {

              return $this->presence_hours_controller->update_presenceday_worker($params);
            }
        );
    }

}


