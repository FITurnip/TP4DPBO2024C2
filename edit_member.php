<?php
include_once("Autoload/autoload.php");
include_once("Controllers/Member.controller.php");
$memberView = new MemberController();

if($_SERVER["REQUEST_METHOD"] == "GET") $memberView->getEdit($_GET["id"]);
else if($_SERVER["REQUEST_METHOD"] == "POST") $memberView->updateData($_POST, $_GET["id"]);