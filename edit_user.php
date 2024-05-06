<?php
include_once("Autoload/autoload.php");
include_once("Controllers/User.controller.php");
$userView = new UserController();

if($_SERVER["REQUEST_METHOD"] == "GET") $userView->getEdit($_GET["id"]);
else if($_SERVER["REQUEST_METHOD"] == "POST") $userView->updateData($_POST, $_GET["id"]);