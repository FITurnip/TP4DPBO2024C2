<?php
class MemberView {
    private $url = 'templates/';
    private $input_html = '<label> NAME: </label>
    <input type="text" name="name" class="form-control" value="__NAME_VALUE__"> <br>
    
    <label> EMAIL: </label>
    <input type="text" name="email" class="form-control" value="__EMAIL_VALUE__"> <br>
    
    <label> PHONE: </label>
    <input type="text" name="phone" class="form-control" value="__PHONE_VALUE__"> <br>';
    private $nav = '<li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="user.php">User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="type.php">Type</a>
    </li>';

    public function __construct($filename) {
        $this->url = $this->url . $filename . '.html';
    }
    
    public function renderIndex($datas) {
        $thead = "<th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>JOINING DATE</th>
            <th>ACTIONS</th>";

        $tbody = "";
        foreach($datas as $data) {
            $tbody .= "<tr>
                <th>$data[id]</th>
                <td>$data[name]</td>
                <td>$data[email]</td>
                <td>$data[phone]</td>
                <td>$data[joining_date]</td>
                <td>
                        <a class='btn btn-success' href='edit_member.php?id=$data[id]'>Edit</a>
                        <a class='btn btn-danger' href='delete_member.php?id=$data[id]'>Delete</a>
                        </td>
            </tr>";
        }
        
        $tp = new Template($this->url);
        $tp->replace('__ADD_NEW_URL__', 'create_member.php');
        $tp->replace('__THEAD__', $thead);
        $tp->replace('__TBODY__', $tbody);
        $tp->replace('__NAV__', $this->nav);
        $tp->write();
    }

    public function getFormTemplate($action, $title, $value) {
        $tp = new Template($this->url);
        $tp->replace('__ACTION__', $action);
        $tp->replace('__TITLE__', $title);
        $tp->replace('__INPUT_LIST__', $this->input_html);
        $tp->replace('__NAME_VALUE__', $value["name"]);
        $tp->replace('__EMAIL_VALUE__', $value["email"]);
        $tp->replace('__PHONE_VALUE__', $value["phone"]);
        $tp->write();
    }
    
    public function renderCreateForm() {
        $this->getFormTemplate('#', 'Create New Member', ["name" => "", "email" => "", "phone" => ""]);
    }

    public function renderEditForm($value) {
        $this->getFormTemplate('#', 'Edit Member Data', $value);
    }
}