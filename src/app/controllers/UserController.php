<?php
    // namespace controllers;
    #require_once "/var/www/html/app/models/User.php";

    use libraries\Controller;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this -> user = $this -> model('User');
    }

    public function login()
    {
        $result = $this -> user::find_by_email_and_password($_POST['email'], $_POST['password']);

        //Checking if Logged in Successfully
        if (count((array)($result)) == 6) {
            $_SESSION['user'] = $this -> createUserObject($result);
            /**
             * Redirect to Login if Status is Restricted
             */
            $this -> checkStatus();
            /**
             * If Status is Approved check Role
             */
            $this -> checkRole();
        } else {
            header("location: ".URLROOT."/public/pages/login?signup=error");
        }
    }

    private function createUserObject($result)
    {
        $arr = array(
        "User_ID" => $result -> user_id,
        "Name" => $result -> name,
        "Email" => $result -> email,
        "Password" => $result -> password,
        "Role" => $result -> role,
        "Status" => $result -> status,
        );
        return (object) $arr;
    }

    public function register()
    {
        $this -> user -> name = $_POST['name'];
        $this -> user -> email = $_POST['email'];
        $this -> user -> password = $_POST['password'];
        $this -> user -> role = "User";
        $this -> user -> status = "Pending";
        $this -> user -> save();
        header("location: ".URLROOT."/public/pages/login?falseconfirm");
    }

    /**
    * checkStatus
    * If Logged in USER Status is Restricted
    * returns to login page
    * @return void
    */
    public function checkStatus()
    {
        if (($this -> getUserData($_SESSION['user'], 'Status')) != 'Approved') {
            header("location: ".URLROOT."/public/pages/login?falseconfirm");
            exit(0);
        }
    }

    /**
     * checkRole
     * Checks the Role of the Logged in User and redirects Accordingly
     * @return void
     */
    public function checkRole()
    {
        switch ($this -> getUserData($_SESSION['user'], 'Role'))
        {
            case 'Admin':
                header('location: '.URLROOT.'/public/AdminController/admin');
                break;
            
            case 'Customer':
                header('location: '.URLROOT.'/public/pages/');
                break;
        }
    }

    /**
     * getUserData
     * returns the data from session
     *
     * @param [type] $_SESSION
     * @param [type] $data
     * $data = 'Status' | 'Role' | 'User_ID'
     * @return void
     */
    public function getUserData($object, $data)
    {
        switch ($data)
        {
            case 'Status':
                return $object -> Status;
            
            case 'Role':
                return $object -> Role;

            case 'User_ID':
                return $object -> User_ID;
        }
    }
}
