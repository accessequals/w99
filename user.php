<?php
require_once("includes/class.report_tool.php");

$user = $_SESSION['reptool']->GetUser($_GET['id']);
extract($user);


?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$first_name?> <?=last_name?>'s homepage</title>
</head>
<body>
<h1><?=$first_name?> <?=last_name?>'s homepage</h1>
</body>
</html>