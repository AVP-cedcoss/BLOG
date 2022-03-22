<?php

    // use Model\Admin;
    // use App\Models\User;
    require_once("../app/libraries/php-activerecord/ActiveRecord.php");
    require_once("../app/Models/User.php");
    require_once("../app/Models/Admin.php");
    require_once("../app/controllers/BlogController.php");
   
    //$USER = new User();
    $ADMIN = new Admin();
    $BLOG = new BlogController();
