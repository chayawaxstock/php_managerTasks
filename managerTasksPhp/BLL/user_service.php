<?php

class user_service extends base_service {

    // function get_users_query() {
    //  $query = "SELECT u.*,department_name,tl.user_name as team_leader_name FROM task_management.user u " .
    //      "LEFT JOIN task_management.department d on u.department_id=d.department_id " .
    //     "LEFT JOIN task_management.user tl ON u.team_leader_id=tl.user_id " .
    //     "WHERE u.is_active=1 ";
    // return $query;
    // }

    function get_users($query) {
        $users = db_access:: run_reader($query, function ($model) {
                    return $this->init_user($model);
                });
        return $users;
    }

    //good
    function get_all_users() {

        $query = 'SELECT u.*,d.*,uu.userName as managerUserName,
                uu.departmentUserId as managerDepartmentUserId,
                uu.email as managerEmail,
                uu.numHourWork as managerNumHourWork
                FROM user u JOIN department d ON u.departmentUserId=d.id
                LEFT JOIN user uu ON u.managerId=uu.id';
        return $this->get_users($query);
    }

    function login_by_password($user_name, $password) {
        $query = "SELECT * FROM managertasks.user JOIN managertasks.department ON user.departmentUserId=department.id  WHERE password='$password' AND userName='$user_name'";
        return $this->get_users($query)[0];
    }

    function forget_password($user_name) {
        $query = "SELECT * FROM managertasks.user WHERE userNam='$user_name'";
        return $this->get_users($query);
    }
    function user_by_department($department_name) {
     $query = "SELECT * FROM managertasks.user JOIN managertasks.department ON user.departmentUserId=department.id WHERE Department='$department_name'";
     return $this->get_users($query);
     }

    function sum_hours_done_users($team_leader_id, $project_id) {
        $query = "SELECT sum(sumHours),u.userName FROM presentday p JOIN user u on u.id= p.id WHERE u.managerId =$team_leader_id AND projectId=$project_id GROUP BY u.id";
        return $this->get_users($query);}


    function delete_user($userId) {
    $query = "DELETE FROM managertasks.user WHERE id=$userId";
    return db_access::run_non_query($query);
    }
    
    function hours_for_projects_user($user_id) {
    $query = "SELECT pw.projectId,pw.id,pw.hoursForProject,p.name,u.userName FROM   project p JOIN projectworker pw ON  p.projectId =pw.projectId JOIN user u ON pw.id =u.id WHERE pw.id=$user_id";
    return $this->get_users($query);
    }
    function add_user($user) {       
        if ($user['managerId'] == 0 || $user['managerId'] == null)
	$query = "INSERT INTO `managertasks`.`user`(`userName`,`userComputer`,`password`,`departmentUserId`,`email`,`numHourWork`) VALUES('{$user['userName']}','{$user['userComputer']}','{$user['password']}',{$user['departmentId']},'{$user['email']}',{$user['numHoursWork']}); ";
	else
	$query = "INSERT INTO `managertasks`.`user`(`userName`,`userComputer`,`password`,`departmentUserId`,`email`,`numHourWork`,`managerId`) VALUES('{$user['userName']}','{$user['userComputer']}','{$user['password']}',{$user['departmentId']},'{$user['email']}',{$user['numHoursWork']},{$user['managerId']}); ";
	return db_access::run_non_query($query);
	}
    
    
    function worker_hours_do_projects($team_leader_id, $project_id) {
        $query = "SELECT sum(pd.sumHours),u.userName  FROM user u JOIN projectworker pw ON pw.id = u.id LEFT JOIN presentday pd ON pd.id = u.id WHERE u.managerId = $team_leader_id AND pw.projectId = $project_id AND pd.projectId = $project_id GROUP BY pw.projectId ,pw.id ";
        return $this->get_users($query)[0];
    }

    function users_belong_projects($project_id) {
        $query = "SELECT * FROM project p JOIN projectworker pw ON  p.projectId =pw.projectId JOIN user u ON pw.id =u.id WHERE pw.projectId=$project_id AND pw.isActive=true";
        return $this->get_users($query)[0];
    }

    function simple_worker() {
        $query = "SELECT * FROM managertasks.user JOIN managertasks.department ON user.departmentUserId=department.id WHERE Department NOT IN ('teamLeader','manager')";
        return $this->get_users($query)[0];
    }

    function project_manager($team_leader_id) {
        $query = "SELECT * FROM managertasks.project WHERE managerId =$team_leader_id";
        return $this->get_users($query)[0];
    }

    function projects_user($user_id) {
        $query = "SELECT *,(select sum(sumHours) from presentday pd where pd.id=pw.id and pd.projectId=p.projectId group by id) as sumHoursDone FROM managertasks.projectworker pw join project p on  pw.projectId = p.projectId where pw.id = $user_id and p.isFinish=false ";
        return $this->get_users($query)[0];
    }

    function user_details() {
        $query = "SELECT * FROM managertasks.user JOIN managertasks.department ON user.departmentUserId=department.id WHERE user.id={id}";
        return $this->get_users($query)[0];
    }

    function login_by_ip($ip) {
        $query = "SELECT* FROM managertasks.user JOIN managertasks.department ON user.departmentUserId = department.id  WHERE userComputer = '$ip'";
        return $this->get_users($query)[0];
    }

    function forgot_password($user_name) {
        $query = "SELECT * FROM managertasks.user WHERE userName='$user_name'";
        $users = $this->get_users($query);
        $date_now = date("Y-m-d H:i:s");
        $date_hour_next = date("Y-m-d H:i:s", strtotime('+1 hours'));
        if ($users) {
            $query = "INSERT INTO requestpassword(userName,dateCreate,dateExpirence) value('$user_name','$date_now' ,'$date_hour_next');";
            echo $query;
            $result = db_access::run_non_query($query);
            echo $result->affected_rows;
            if ($result->affected_rows > 0) {
                $insert_id = $result->insert_id;
                $email_to = $users[0]["email"];
                return $this->send_email_forgot_password($insert_id, $user_name, $email_to);
            }
        }
    }

    function send_email_forgot_password($request_id, $user_name, $email_to) {
        $subject = "change password";
        $message = "
              <html>
              <body>
              <h3>Dear $user_name,</h3><br>
              <h4><a href='http://localhost:4200/changePassword/$request_id'>link to change password</a></h4>
              <h4>Thank you!</h4>
              </body>
              </html>";

        return send_email_service::send_email($email_to, $subject, $message);
    }

    function hours_done_user_by_projects($user_id) {
        $query = "SELECT * FROM sumHoursForUserProject WHERE id=$user_id";
        return db_access::run_reader($query, function ($model) {
                return $model;
        });
    }

}
