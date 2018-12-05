<?php

class project_controller {

    var $project_service;

    function __construct() {
        $this->project_service = new project_service();
    }

    function getAllProjects() {

        return $this->project_service->get_all_projects();
    }

//    function create_reports($report_id) {
//        $viewName = "";
//
//        switch ($report_id) {
//            case 1:
//                 $viewName = "reportProject";
//                return $this->project_service->create_reports_projects($viewName);
//            default:
//                $viewName = "reportWorker";
//                    return $this->project_service->create_reports_workers($viewName);
//                break;
//        }
//       
//    }


}
