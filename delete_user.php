<?php
include_once("Autoload/autoload.php");
include_once("Controllers/User.controller.php");
$userView = new UserController();

$userView->delete($_GET["id"]);