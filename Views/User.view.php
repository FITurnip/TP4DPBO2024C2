<?php
class UserView {
    private $url = 'templates/';
    private $input_html = '<label> USERNAME: </label>
    <input type="text" name="username" class="form-control" value="__USERNAME_VALUE__"> <br>
    
    <label> PASSWORD: </label>
    <input type="text" name="password" class="form-control" value="__PASSWORD_VALUE__"> <br>
    
    <label> MEMBER: </label>
    <select name="member_id" class="form-select">__MEMBER_OPTION__</select><br>
    
    <label> TYPE: </label>
    <select name="type_id" class="form-select">__TYPE_OPTION__</select><br>';

    private $nav = '<li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="user.php">User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="type.php">Type</a>
    </li>';

    public function __construct($filename) {
        $this->url = $this->url . $filename . '.html';
    }
    
    public function renderIndex($datas) {
        $thead = "<th>ID</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>MEMBER NAME</th>
            <th>TYPE</th>
            <th>ACTION</th>";
        $tbody = "";
        foreach($datas as $data) {
            $tbody .= "<tr>
                <th>$data[id]</th>
                <td>$data[username]</td>
                <td>$data[password]</td>
                <td>$data[member_name]</td>
                <td>$data[type_name]</td>
                <td>
                        <a class='btn btn-success' href='edit_user.php?id=$data[id]'>Edit</a>
                        <a class='btn btn-danger' href='delete_user.php?id=$data[id]'>Delete</a>
                        </td>
            </tr>";
        }
        
        $tp = new Template($this->url);
        $tp->replace('__ADD_NEW_URL__', 'create_user.php');
        $tp->replace('__THEAD__', $thead);
        $tp->replace('__TBODY__', $tbody);
        $tp->replace('__NAV__', $this->nav);
        $tp->write();
    }

    public function getFormTemplate($action, $title, $value) {
        $member_option = "<option value=''>Select The Member</option>";
        foreach($value["members"] as $member) {
            $member_option .= "<option value='$member[id]'>$member[name]</option>";
        }

        $type_option = "<option value=''>Select The Type</option>";
        foreach($value["types"] as $type) {
            $type_option .= "<option value='$type[id]'>$type[type_name]</option>";
        }

        $tp = new Template($this->url);
        $tp->replace('__ACTION__', $action);
        $tp->replace('__TITLE__', $title);
        $tp->replace('__INPUT_LIST__', $this->input_html);
        $tp->replace('__MEMBER_OPTION__', $member_option);
        $tp->replace('__TYPE_OPTION__', $type_option);
        $tp->replace('__USERNAME_VALUE__', $value["username"]);
        $tp->replace('__PASSWORD_VALUE__', $value["password"]);

        $tp->write();
    }
    
    public function renderCreateForm($memberData, $typeData) {
        $this->getFormTemplate('#', 'Create New User', ["username" => "", "password" => "", "members" => $memberData, "types" => $typeData]);
    }

    public function renderEditForm($value) {
        $this->getFormTemplate('#', 'Edit User Data', $value);
    }
}