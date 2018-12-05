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

    function get_all_users($manager_id) {
       $query ='SELECT * FROM user u JOIN department d ON u.departmentUserId=d.id LEFT JOIN user uu ON u.managerId=uu.id';
        return $this->get_users($query);
    }
    
     function get_all_department($manager_id) {
       $query ='SELECT * FROM user u JOIN department d ON u.departmentUserId=d.id LEFT JOIN user uu ON u.managerId=uu.id';
        return $this->get_users($query);
    }

   // function get_all_team_users($team_leader_id) {
   //     $query = $this->get_users_query() . " AND u.team_leader_id=$team_leader_id;";
   //     return $this->get_users($query);
   // }

  //  function get_all_team_leaders($manager_id) {
   //     $query = $this->get_users_query() . " AND u.team_leader_id IS NULL AND u.manager_id=$manager_id;";
   //     return $this->get_users($query);
   // }

  //  function get_user_by_id($user_id) {
  //      $query = $this->get_users_query() . " AND u.user_id=$user_id;";
  //      return $this->get_users($query)[0];
   // }

}
