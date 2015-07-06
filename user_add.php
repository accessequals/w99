<?php
require_once("includes/class.report_tool.php");
$company = $_SESSION['reptool']->GetCompany($_GET['company_id']);
extract($company);
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add a user for <?=$company_name?></title>
</head>
<body>
<h1>Add a user for <?=$company_name?></h1>
<form action="user_add_do.php" method="post">
<input type="hidden" name="company_id" value="<?=$id?>" />

<p>
<label for="first_name">First name</label>
<input name="first_name" id="first_name" type="text" size="50" />
</p>

<p>
<label for="last_name">Last name</label>
<input name="last_name" id="last_name" type="text" size="50" />
</p>

<p>
<label for="email">Email</label>
<input name="email" id="email" type="text" size="80" />
</p>

<p>
<label for="phone">Phone</label>
<input name="phone" id="phone" size="20" />
</p>

<fieldset>
<legend>This user can</legend>
<input type="checkbox" name="privilege[]" id="privilege1" value="1" />
<label for="privilege_1">Read company info</label>

<input type="checkbox" name="privilege[]" id="privilege2" value="2" />
<label for="privilege_1">Edit company info</label>
</fieldset>

<p>
<input type="submit" value="Save this user" />
</p>
</form>
</body>
</html>