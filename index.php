<?php
require_once("includes/class.report_tool.php");
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reporting tool</title>
</head>
<body>
<h1>Reporting tool</h1>
<h2>The narrative</h2>
<ol>
<li><a href="company_add.php">Add a company</a> or click on an existing one.</li>
<li>Create evaluation reports for this company.</li>
<li>Add some users to the company.</li>
</ol>
<hr />
<h2>Companies</h2>
<ul>
<?=$_SESSION['reptool']->GetCompanies("list")?>
</ul>
</body>
</html>