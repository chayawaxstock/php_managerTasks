<?php

class base_service {

    function init_user($user) {
       // $new_user = array();
       // $new_user['userId'] = $user['user_id'];
       // $new_user['userName'] = $user['user_name'];
       // $new_user['email'] = $user['email'];
       // $new_user['password'] = $user['password'];
       // $new_user['profileImageName'] = $user['profile_image_name'];
      //  $new_user['departmentId'] = $user['department_id'];
      //  $new_user['teamLeaderId'] = $user['team_leader_id'];
      //  $new_user['managerId'] = $user['manager_id'];
      //  $new_user['isActive'] = $user['is_active'];
      //  if (array_key_exists('department_name', $user)) {
      //      $new_user['department'] = array();
      //      $new_user['department']['departmentName'] = $user['department_name'];
      //  }
      //  if (array_key_exists('team_leader_name', $user)) {
       //     $new_user['teamLeader'] = array();
       //     $new_user['teamLeader']['userName'] = $user['team_leader_name'];
       // }
       // return $new_user;
    }


    function init_project($project) {
//      print_r($project);
          $new_project = array();
        $new_project['projectId'] = $project['projectId'];
        $new_project['projectName'] = $project['name'];
        $new_project['customerName'] = $project['customerName'];
        $new_project['numHourForProject'] = $project['numHour'];
        $new_project['dateBegin'] = $project['dateBegin'];
        $new_project['dateEnd'] = $project['dateEnd'];
        $new_project['isFinish'] = $project['isFinish'];
        $new_project['idManager'] = $project['managerId'];     
        if (array_key_exists('id', $project)) {
            $new_project['manager'] = array();
            $new_project['manager']['userName'] = $project['userName'];
        }
          print_r($new_project);
        return $new_project;
    }
    
    
  function init_projectworker($model) {
      print_r($model);

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
