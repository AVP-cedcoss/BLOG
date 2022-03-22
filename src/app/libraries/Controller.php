<?php
    namespace libraries;

class Controller
{
    public function model($model)
    {
        require_once APPROOT."/libraries/php-activerecord/ActiveRecord.php";

        \ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_model_directory(APPROOT . '/Models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:secret@mysql-server/Blog'));
        });

        /*$log = \Log::singleton('file', APPPATH . '/../private/logs/sql.log'); //using PEAR Log
        \ActiveRecord\Config::instance()->set_logging(true);
        \ActiveRecord\Config::instance()->set_logger($log); */
        
        //Require Model File
        require_once(APPROOT.'/Models/'.$model.'.php');

        //Initiate Model
        return new $model;
    }

    //Loads the view (checks for file)
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/'. $view . '.php')) {
            require_once('../app/views/'. $view . '.php');
        } else {
            die("../app/views/pages/home.php");
        }
    }
}
