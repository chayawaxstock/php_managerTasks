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
        $this->project_worker_controller = new projectworker_controller();
        $this->presence_hours_controller = new presentday_controller();

        $this->methods = array(
            'user' => $this->get_users_methods(),
            'project' => $this->get_projects_methods(),
            'department' => $this->get_departments_methods(),
            'projectworker' => $this->get_project_worker_methods(),
            'presenceday' => $this->get_presence_day_methods()
        );
    }

    function invoke($controller_name, $method_name, $params) {

        $data = $this->methods[$controller_name][$method_name]($params);
        return json_encode($data);
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
            },
            'deleteUser' => function ($params) {
                return $this->user_controller->delete_user($params['userId']);
            },
            'addUser' => function ($params) {
                return $this->user_controller->add_user($params);
            },
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

                return $this->department_controller->getAllDepartments();
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
            'GetPresenceStatusPerWorkers' => function ($params) {

                // return $this->$presence_hours_controller->get_presence_status_per_workers($params['teamLeaderId']);
            }
        );
    }

}
