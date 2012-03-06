<?php
include_once('project/model/widgetModel.php');

class WidgetController
{
     public $model;	

     public function __construct()
     {
          $this->model = new WidgetModel();
     } 

     public function invoke()
     {
          $horde_nb = $this->model->getHordePlayersNb();
          $ally_nb = $this->model->getAlliancePlayersNb();
          $is_online = $this->model->isServerOnline();
          $uptime = $this->model->getServerUptime();

          include 'project/view/widgetView.php';
     }
}
