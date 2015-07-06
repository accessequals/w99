<?php
require_once("includes/class.report_tool.php");
$company = $_SESSION['reptool']->GetCompany($_GET['id']);
extract($company);
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$company_name?></title>
</head>
<body>
<h1><?=$company_name?></h1>
<p>Address: <?=$address?></p>
<p>Phone: <?=$phone?></p>
<h2>Reports</h2>
<p><a href="report_add.php?company_id=<?=$id?>">Create a new report</a></p>
<h2>Users</h2>
<p><a href="user_add.php?company_id=<?=$id?>">Add a user</a></p>
</body>
</html>