<?php
class TypeView {
    private $url = 'templates/';
    private $input_html = '<label> TYPE: </label>
    <input type="text" name="type_name" class="form-control" value="__TYPE_VALUE__"> <br>
    
    <label> INFORMATION: </label>
    <input type="text" name="information" class="form-control" value="__INFORMATION_VALUE__"> <br>';

    private $nav = '<li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="user.php">User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="type.php">Type</a>
    </li>';

    public function __construct($filename) {
        $this->url = $this->url . $filename . '.html';
    }
    
    public function renderIndex($datas) {
        $thead = "<th>ID</th>
            <th>TYPE NAME</th>
            <th>INFORMATION</th>
            <th>ACTION</th>";
        $tbody = "";
        foreach($datas as $data) {
            $tbody .= "<tr>
                <th>$data[id]</th>
                <td>$data[type_name]</td>
                <td>$data[information]</td>
                <td>
                        <a class='btn btn-success' href='edit_type.php?id=$data[id]'>Edit</a>
                        <a class='btn btn-danger' href='delete_type.php?id=$data[id]'>Delete</a>
                        </td>
            </tr>";
        }
        
        $tp = new Template($this->url);
        $tp->replace('__ADD_NEW_URL__', 'create_type.php');
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
        $tp->replace('__TYPE_VALUE__', $value["type_name"]);
        $tp->replace('__INFORMATION_VALUE__', $value["information"]);

        $tp->write();
    }
    
    public function renderCreateForm() {
        $this->getFormTemplate('#', 'Create New Type', ["type_name" => "", "information" => ""]);
    }

    public function renderEditForm($value) {
        $this->getFormTemplate('#', 'Edit Type Data', $value);
    }
}