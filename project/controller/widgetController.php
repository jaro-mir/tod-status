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
   
        $layout = isset($_GET['layout'])?$_GET['layout']:null;
        switch($layout)
        {
            case 'storm':
                include 'project/view/widgetStormView.php';
                break;
            case 'storm_h':
                include 'project/view/widgetStormHorizontalView.php';
                break;
            default:
                include 'project/view/widgetView.php';
        }
    }
}
