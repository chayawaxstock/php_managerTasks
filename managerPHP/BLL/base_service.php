<?php

class base_service  {

    function init_user($user) {
       // print_r($user);
        $new_user = array();
        $new_user['userId'] = $user['id'];
        $new_user['userName'] = $user['userName'];
        $new_user['email'] = $user['email'];
        
        $new_user['numHoursWork'] = $user['numHourWork'];
        $new_user['managerId'] = $user['managerId'];

        if (array_key_exists('department', $user)) {
            $new_user['departmentUser'] = array();
            $new_user['departmentUser']['id'] = $user['id'];
            $new_user['departmentUser']['department'] = $user['department'];
        }
        if (array_key_exists('managerUserName', $user)) {
           $new_user['manager'] = array();
           $new_user['manager']['userId'] = $user['managerId'];
           $new_user['manager']['userName'] = $user['managerUserName'];
           $new_user['manager']['email'] = $user['managerEmail'];
           $new_user['manager']['numHoursWork'] = $user['managerNumHourWork'];
        }
        return $new_user;
    }

    function init_project($model) {
        echo 'init project';
    }

    function init_department($department) {
        $new_department = array();
        $new_department['id'] = $department['id'];
        $new_department['department'] = $department['department'];
        return $new_department;
    }

    function init_worker_hours($worker_hours) {
       // $new_worker_hours = array();
       // $new_worker_hours['workerHoursId'] = $worker_hours['worker_hours_id'];
       // $new_worker_hours['projectId'] = $worker_hours['project_id'];
      //  $new_worker_hours['workerId'] = $worker_hours['worker_id'];
      //  $new_worker_hours['numHours'] = $worker_hours['num_hours'];
      //  $new_worker_hours['isComplete'] = $worker_hours['is_complete'];
      //  $new_worker_hours['project'] = array();
      //  $new_worker_hours['project']['projectName'] = $worker_hours['project_name'];
      //  $new_worker_hours['worker'] = array();
      //  $new_worker_hours['worker']['userName'] = $worker_hours['user_name'];
       // $new_worker_hours['worker']['email'] = $worker_hours['email'];
       // $new_worker_hours['worker']['department'] = array();
       // $new_worker_hours['worker']['department']['departmentName'] = $worker_hours['department_name'];
       // return $new_worker_hours;
    }

    function init_department_hours($department_hours) {
       // $new_department_hours = array();
       // $new_department_hours['departmentHoursId'] = $department_hours['department_hours_id'];
       // $new_department_hours['projectId'] = $department_hours['project_id'];
       // $new_department_hours['departmentId'] = $department_hours['department_id'];
       // $new_department_hours['numHours'] = $department_hours['num_hours'];
        //$new_department_hours['department'] = array();
       // $new_department_hours['department']['departmentName'] = $department_hours['department_name'];
       // return $new_department_hours;
    }
    
  
    
    
   

}

