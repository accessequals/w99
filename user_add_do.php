<?php
require_once("includes/class.report_tool.php");

$data = $_POST;
$data['created_by_id'] = $_SESSION['reptool']->id;
$data['privileges'] = 0;
foreach($data['privilege'] as $priv)
	$data['privileges'] += $priv;
unset($data['privilege']);

//Add the user to the database
$user_id = $_SESSION['reptool']->AddUser($data);
if ($user_id == null)
die("Can't add user");

//Prepare the email to reset password

$msg = <<<EOF
<!doctype html>
<html lang="en">
<head>
<title>Reset your AccessEquals password</title>
</head>
<body>
<h1>Reset your AccessEquals password</h1>
<p>Your details have been added to the AccessEquals database and you can now log in.</p>
<p>First please use the one-time login link below to ccreate your password.</p>
<p><a href="http://accessequals.com/wcag/set_password.php?user_id=$user_id">Create your password</a></p>
<p>Thank you,</p>
<p>The AccessEquals team</p>
</body>
</html>
EOF;

$to = $data['email'];
$subject = "Reset your AccessEquals password";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@accessequals.com\r\n";
mail($to, $subject, $msg, $headers) ;

header("Location: user.php?id=$user_id");
?>