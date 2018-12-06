<?php

class user_controller {

    var $user_service;

    function __construct() {
        $this->user_service = new user_service();
    }

	function login($login){
		return $this->user_service->login($login);
	}

    function get_all_users($manager_id) {
        return $this->user_service->get_all_users($manager_id);
    }

    function get_all_team_users($team_leader_id) {
        return $this->user_service->get_all_team_users($team_leader_id);
    }

    function get_all_team_leaders($manager_id) {
        return $this->user_service->get_all_team_leaders($manager_id);
    }

    function get_user_by_id($user_id) {
        return $this->user_service->get_user_by_id($user_id);
    }
    function  delete_user($userId){
         return $this->user_service->delete_user($userId); 
    }
    function add_user($user){
        print_r($user) ;
        return $this->user_service->add_user($user); 
    }
}