<?php

class department_controller {
     var $user_service;

    function __construct() {
        $this->user_service = new user_service();
    }

    function getAllDepartments() {
        return $this->user_service->get_all_departments();
    }

   

}

