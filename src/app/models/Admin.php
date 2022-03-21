<?php
    // namespace Model;

use libraries\Database;

class Admin extends Database
{
    /**
     * Prints All Users
     *
     * @param [type] $data
     * @return void
     */
    public function printAllUsers()
    {
        global $USER;
        $data = $USER -> getAllUsers();
        $html = '';
        foreach ($data as $value) {
            $html.= $USER -> customerEditFalse($value);
        }
        return $html;
    }

    /**
     * Print Selected User Details
     * with Input Values
     *
     * @param [type] $id
     * @return html
     */
    public function editUserPrint($id)
    {
        global $USER;
        $data = $USER -> getAllUsers();
        $html = '';
        foreach ($data as $value) {
            $userStatus = "info";
            if ($value -> User_ID == $id) {
                $html.= $USER -> customerEditTrue($value, $userStatus);
            } else {
                $html.= $USER -> customerEditFalse($value);
            }
        }
        return $html;
    }


    /**
     * displayAllBlogs
     * Prints all Blogs
     *
     * @return html
     */
    public function printAllBlogs()
    {
        global $BLOG;
        $data = $BLOG -> getAllBlogs();
        $html = '';
        foreach ($data as $value) {
            $html.= $BLOG -> blogEditFalse($value);
        }
        return $html;
    }
}
