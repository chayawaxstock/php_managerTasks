<?php

class user_controller {

    var $user_service;

    function __construct() {
        $this->user_service = new user_service();
    }

    function login_by_password($password,$user_name){
	return $this->user_service->login_by_password($user_name,$password);
    }

    function get_all_users() {
        return $this->user_service->get_all_users();
    }

    function get_all_team_users($team_leader_id) {
       // return $this->user_service->get_all_team_users($team_leader_id);
    }

    function get_all_team_leaders($manager_id) {
       // return $this->user_service->get_all_team_leaders($manager_id);
    }

    function get_user_by_id($user_id) {
       // return $this->user_service->get_user_by_id($user_id);
    }
    function login_by_ip($ip) {
        return $this->user_service->login_by_ip($ip);
    }
    
    function  forgot_password($user_name)
    {
        return $this->user_service->forgot_password($user_name);
    }
    
function add_user($user){
 print_r($user) ;
 return $this->user_service->add_user($user); }
    
    function  hours_user_done_projects($user_id)
    {
        return $this->user_service->hours_done_user_by_projects($user_id);
    }
}