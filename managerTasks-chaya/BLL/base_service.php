<?php

class base_service {

 function init_user($user) {
       // print_r($user);
        $new_user = array();
        $new_user['userId'] = $user['id'];
        $new_user['userName'] = $user['userName'];
        $new_user['email'] = $user['email'];
        $new_user['departmentId']=$user['departmentUserId'];
        $new_user['numHoursWork'] = $user['numHourWork'];
        $new_user['managerId'] = $user['managerId'];

        if (array_key_exists('department', $user)) {
            $new_user['departmentUser'] = array();
            $new_user['departmentUser']['id'] = $user['department_id'];
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
        if (array_key_exists('userName', $project)) {
            $new_project['manager'] = array();
            $new_project['manager']['userName'] = $project['userName'];
        }
      
        return $new_project;
    }
    
     function init_worker_project($worker_project) {
        $new_worker_project=array();
        $new_worker_project['projectId']=$worker_project['projectId'];
        $new_worker_project['userId']=$worker_project['name'];
        $new_worker_project['projectName']=$worker_project['customerName'];
        $new_worker_project['hoursForProject']=$worker_project['hoursForProject'];
        if(array_key_exists('sumHoursDone', $worker_project))
              $new_worker_project['sumHoursDone']=$worker_project['sumHoursDone'];  
        if(array_key_exists('dateBegin', $worker_project))
        $new_worker_project['project']= $this->init_project ($worker_project);
        if(array_key_exists('userName',$worker_project)){
            $new_worker_project['user']= $this->init_user($worker_project);
        }
        return $new_worker_project;
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

        $new_department_hours = array();
        $new_department_hours['projectId'] = $department_hours['projectId'];
        $new_department_hours['departmentId'] = $department_hours['departmentId'];
        $new_department_hours['sumHours'] = $department_hours['sumHours'];
      
        $new_department_hours['departmentUser'] = array(); 
        $new_department_hours['departmentUser']['id'] = $department_hours['id'];
        $new_department_hours['departmentUser']['department'] = $department_hours['department'];
        return $new_department_hours;
    }
    
      function format_date($date, $format = 'Y-m-d') {
          print_r($date);
        $format_date = date($format, strtotime($date));
        print_r( $format_date);
        return "'$format_date'";
    }

}
