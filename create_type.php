<?php
include_once("Autoload/autoload.php");
include_once("Controllers/Type.controller.php");
$typeView = new TypeController();

if($_SERVER["REQUEST_METHOD"] == "GET") $typeView->getCreate();
else if($_SERVER["REQUEST_METHOD"] == "POST") $typeView->storeData($_POST);