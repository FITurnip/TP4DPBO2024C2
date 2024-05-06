<?php
include_once("Autoload/autoload.php");
include_once("Controllers/User.controller.php");
$userView = new UserController();

if($_SERVER["REQUEST_METHOD"] == "GET") $userView->getCreate();
else if($_SERVER["REQUEST_METHOD"] == "POST") $userView->storeData($_POST);