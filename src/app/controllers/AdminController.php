<?php
    use libraries\Controller;

class AdminController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this -> user = $this -> model('Admin');
    }

    public function admin()
    {
        $this -> view("pages/admin/admin_dashboard");
    }

    public function blogs()
    {
        $this -> view("pages/admin/blogs");
    }

    public function users()
    {
        $this -> view("pages/admin/users");
    }

    public function blogChangeData()
    {
        switch ($_POST['action'])
        {
            case 'statusBlog':
                $this -> changeStatusBlog();
                break;
        }
    }

    public function changeStatusBlog()
    {
        $blog = $this -> model('Blog');
        $data = $blog::find_by_blog_id($_POST['Blog_ID']);
        $data -> blog_status = $_POST['status'];
        $data -> save();
        header("location: ".URLROOT."/public/AdminController/blogs");
    }

    public function userChangeData()
    {
        switch ($_POST['action'])
        {
            case 'updateUser':
                $this -> updateUser();
                break;

            case 'deleteUser':
                $this -> deleteUser();
                break;

            case 'statusUser':
                $this -> changeStatusUser();
                break;
        }
    }

    public function changeStatusUser()
    {
        $User = $this -> model('User');
        $data = $User::find_by_user_id($_POST['User_ID']);
        $data -> status = $_POST['status'];
        $data -> save();
        header("location: ".URLROOT."/public/AdminController/users");
    }

    public function updateUser()
    {
        $User = $this -> model('User');
        $data = $User::find_by_user_id($_POST['User_ID']);
        $data -> name = $_POST['name'];
        $data -> save();
        header("location: ".URLROOT."/public/AdminController/users");
    }

    public function deleteUser()
    {
        $User = $this -> model('User');
        $data = $User::find_by_user_id($_POST['User_ID']);
        $data -> delete();
        header("location: ".URLROOT."/public/AdminController/users");
    }
}
