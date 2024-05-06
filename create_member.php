<?php
include_once("Autoload/autoload.php");
include_once("Controllers/Member.controller.php");
$memberView = new MemberController();

if($_SERVER["REQUEST_METHOD"] == "GET") $memberView->getCreate();
else if($_SERVER["REQUEST_METHOD"] == "POST") $memberView->storeData($_POST);