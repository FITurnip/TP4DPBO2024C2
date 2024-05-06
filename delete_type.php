<?php
include_once("Autoload/autoload.php");
include_once("Controllers/Type.controller.php");
$typeView = new TypeController();

$typeView->delete($_GET["id"]);