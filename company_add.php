<?php
require_once("includes/class.report_tool.php");
$countries = $_SESSION['reptool']->GetCountries();
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add a company</title>
</head>
<body>
<h1>Add a company</h1>
<form action="company_add_do.php" method="post">
<p>
<label for="company_name">Company name</label>
<input name="company_name" id="company_name" type="text" size="50" />
</p>

<p>
<label for="phone">Phone</label>
<input name="phone" id="phone" type="text" size="20" />
</p>

<p>
<label for="address1">Address line 1</label>
<input name="address1" id="address1" type="text" size="50" />
</p>

<p>
<label for="address2">Address line 2</label>
<input name="address2" id="address2" type="text" size="50" />
</p>

<p>
<label for="address3">Address line 3</label>
<input name="address3" id="address3" type="text" size="50" />
</p>

<p>
<label for="town">Town or city</label>
<input name="town" id="town" type="text" size="50" />
</p>

<p>
<label for="county">County</label>
<input name="county" id="county" type="text" size="50" />
</p>

<p>
<label for="zip">Zip/postal code</label>
<input name="zip" id="zip" type="text" size="50" />
</p>

<p>
<label for="country_id">Country</label>
<select name="country_id" id="country_id">
<option value="">choose a country</option>
<?=$countries?>
</select>
</p>

<p>
<input type="submit" value="Save company" />
</p>
</form>
</body>
</html>