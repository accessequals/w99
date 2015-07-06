<?php
require_once("includes/class.report_tool.php");
$data = $_POST;
$data['created_by_id'] = $_SESSION['reptool']->id;

$company_id = $_SESSION['reptool']->AddCompany($data);
header("Location: index.php");
?>