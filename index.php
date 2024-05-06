<?php
include_once("Autoload/autoload.php");
include_once("Controllers/Member.controller.php");
$memberView = new MemberController();
$memberView->getIndex();