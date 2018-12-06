<?php

class presenceday_service {
    
      function update_presenceday_worker($presence_day) {
         $date = DateTime::createFromFormat('d/m/Y H:i:s',$presence_day['timeEnd']);
          echo $date; 
        $query = "set @id=0;select max(presentDayId) into @id from presentday where id = '{$presence_day['userId']}' and projectId ='{$presence_day['projectId']}'; UPDATE `managertasks`.`presentday`SET`timeEnd` = '{$presence_day['timeEnd']}' WHERE presentDayId = @id and id ='{$presence_day['userId']}' and projectId = '{$presence_day['projectId']}'";
        return db_access::run_non_query($query)->affected_rows;
    }
}
