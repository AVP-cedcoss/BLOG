<?php
    // namespace Model;

use libraries\Controller;

class Admin extends Controller
{
    /**
     * Prints All Users
     *
     * @param [type] $data
     * @return void
     */
    public function printAllUsers()
    {
        $data = $this -> model('User')::find('all');
        $html = '';
        foreach ($data as $value) {
            $html.= $this -> customerEditFalse($value);
        }
        return $html;
    }

    /**
     * Customer Edit True
     * Print of Individual User for Admin Customer Page with
     * Input Fields
     *
     * @param [type] $value
     * @param [type] $userStatus
     * @return html
     */
    public function customerEditTrue($value, $userStatus)
    {
        switch ($value -> status)
        {
            case 'Approved':
                $userStatus = "success";
                break;
            
            case 'Restricted':
                $userStatus = "danger";
                break;

            case 'Pending':
                $userStatus = "warning";
                break;
        }
        $html='
                <form method="POST" action="'.URLROOT.'/public/AdminController/userChangeData">
                <tr class="text-align-center bg-'.$userStatus.' text-light">
                    <td class="p-3 text-start">'.$value -> user_id.'</td>
                    <td class="p-3"><input type="text" name="name" value="'.$value -> name.'"></td>
                    <td class="p-3 fst-italic">'.$value -> email.' </td>
                    <td class="p-3 fw-bold">'.$value -> role.'<input type="hidden" name="User_ID" 
                    value='.$value -> user_id.'> </td>
                    <td class="p-1"><button class="m-1 p-2 btn-primary rounded" name="action" 
                    value="updateUser" type="submit">Update User</button></td>
                    <td class="p-1"><button class="m-1 p-2 btn-danger rounded" name="action" 
                    value="deleteUser" type="submit" disabled>Delete</button></td>';

        switch ($value -> status)
        {
            case 'Approved':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Approved</option>
                        <option>Restricted</option>
                        <option>Pending</option>
                    </select></td>';
                break;
            
            case 'Restricted':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Restricted</option>
                        <option>Approved</option>
                        <option>Pending</option>
                    </select></td>';
                break;

            case 'Pending':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Restricted</option>
                    </select></td>';
                break;
        }
        $html.='
                <td class="p-1">
                    <button class="m-1 p-2 border-0 btn-'.$userStatus.' rounded" 
                    name="action" value="statusUser" disabled> 
                        Update Status
                    </button>
                </td>
            </tr>
        </form>';
        return $html;
    }

    /**
     * Customer Edit False
     * Default Print of Individual User for Admin Customer Page
     * No Input Fields
     *
     * @param [type] $value
     * @return html
     */
    public function customerEditFalse($value)
    {
        switch ($value -> status)
        {
            case 'Approved':
                $userStatus = "success";
                break;
            
            case 'Restricted':
                $userStatus = "danger";
                break;

            case 'Pending':
                $userStatus = "warning";
                break;
        }
        $html='
            <form method="POST" action="'.URLROOT.'/public/AdminController/userChangeData">
            <tr class="text-align-center bg-'.$userStatus.' text-light">
                <td class="p-3 text-start">'.$value -> user_id.'</td>
                <td class="p-3">'.$value -> name.'</td>
                <td class="p-3 fst-italic">'.$value -> email.' </td>
                <td class="p-3 fw-bold">'.$value -> role.'<input type="hidden" name="User_ID" 
                value='.$value -> user_id.'> </td>
                <td class="p-1"><a class="m-1 p-2 btn-primary rounded text-decoration-none text-center" 
                href="?action=edit&id='.$value -> user_id.'" 
                name="action" value="edit"  type="submit">Edit User</a></td>
                <td class="p-1"><button class="m-1 p-2 btn-danger rounded" name="action" 
                value="deleteUser" type="submit">Delete</button></td>';

        switch ($value -> status)
        {
            case 'Approved':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Approved</option>
                        <option>Restricted</option>
                        <option>Pending</option>
                    </select></td>';
                break;
            
            case 'Restricted':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Restricted</option>
                        <option>Approved</option>
                        <option>Pending</option>
                    </select></td>';
                break;

            case 'Pending':
                $html.= '<td class="p-1">
                    <select class="m-1 p-2 rounded" name="status">
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Restricted</option>
                    </select></td>';
                break;
        }
        $html.='
            <td class="p-1">
                <button class="m-1 p-2 border-0 btn-'.$userStatus.' rounded" name="action" value="statusUser"> 
                    Update Status
                </button>
            </td>
        </tr>
        </form>';
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
        $data = $this -> model('User')::find('all');
        $html = '';
        foreach ($data as $value) {
            $userStatus = "info";
            if ($value -> user_id == $id) {
                $html.= $this -> customerEditTrue($value, $userStatus);
            } else {
                $html.= $this -> customerEditFalse($value);
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
