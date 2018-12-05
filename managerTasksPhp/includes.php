<?php

//ROUTER
require './routes_loader.php';

//API
require './API/controllers/projectworker_controller.php';
require './API/controllers/department_controller.php';
require './API/controllers/presentday_controller.php';
require './API/controllers/project_controller.php';

require './API/controllers/user_controller.php';

//BLL
require './BLL/base_service.php';
require './BLL/user_service.php';
require './BLL/projectworker_service.php';
require './BLL/project_service.php';
require './BLL/pressentday_service.php';

//DAL
require './DAL/db_access.php';
require './DAL/db_info.php';


