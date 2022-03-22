<?php
    use libraries\Controller;

class BlogController extends Controller
{
    private $blog;

    public function __construct()
    {
        $this -> blog = $this -> model('Blog');
    }

    public function addBlog()
    {
        
        $this -> blog -> addBlog($_POST['name'], $_POST['content'], $_POST['User_ID']);
    }
    
    public function post()
    {
        $data = [
            $_POST['Blog_ID']
        ];
        $this -> view("pages/post", $data);
    }

    public function newPost()
    {
        $this -> view("pages/addPost");
    }

    public function addPost()
    {
        $this -> blog -> blog_name = $_POST['Blog_name'];
        $this -> blog -> blog_content = $_POST['Content'];
        $this -> blog -> blog_author_id = $_POST['Author_ID'];
        $this -> blog -> blog_status = "Pending";
        $this -> blog -> save();
        header("location: ".URLROOT."/public");
    }

    public function printPostPreviews()
    {
        $data = $this -> blog::find('all');
        $html = '';
        foreach ($data as $post) {
            if ($post -> blog_status != "Approved") {
                continue;
            }
            $html.='
            <div class="post-preview">
            <form action="'.URLROOT.'/public/BlogController/post" method="POST">
                    <h2 class="post-title">'.$post -> blog_name.'</h2>
                <button name="Blog_ID" value="'.$post -> blog_id.'" class="p-2 btn rounded bg-primary text-light">
                    Read Post
                </button>
            </form>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
            ';
        }
        return $html;
    }

    public function blogStatusCheck($Blog_ID)
    {
        $result = $this -> blog::find_by_blog_id($Blog_ID);
        return (array)($result -> blog_status);
    }

    public function printHeadingPost($Blog_ID)
    {
        $result = $this -> blog::find_by_blog_id($Blog_ID);
        $html='
            <h1>'.$result -> blog_name.'</h1>
            <span class="meta">
            </span>
        ';
        return $html;
    }

    public function printPost($Blog_ID)
    {
        $result = $this -> blog::find_by_blog_id($Blog_ID);
        $html='
            <p>'.$result -> blog_content.'</p>
        ';
        return $html;
    }

    /**
     * Blog Edit False
     * Default Print of Individual Blog for Admin Blog Page
     * No Input Fields
     *
     * @param [type] $value
     * @return html
     */
    public function blogEditFalse($value)
    {
        switch ($value -> blog_status)
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
            <form method="POST" action="'.URLROOT.'/public/AdminController/blogChangeData">
            <tr class="text-align-center bg-'.$userStatus.' text-light">
                <td class="p-3 text-start">'.$value -> blog_id.'</td>
                <td class="p-3">'.$value -> blog_name.' <input type="hidden" name="Blog_ID" 
                value='.$value -> blog_id.'></td>
                ';

        switch ($value -> blog_status)
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
                <button class="m-1 p-2 border-0 btn-'.$userStatus.' rounded" name="action" value="statusBlog"> 
                    Update Status
                </button>
            </td>
        </tr>
        </form>';
        return $html;
    }
}
