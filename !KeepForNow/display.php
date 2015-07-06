<?php
require_once("class.db.php");
$db = new DB;

$html = "<h1>WCAG guidelines</h1>\n";

$arrPrinciples = $db->GetAllRows("select * from lk_principle");
foreach($arrPrinciples as $key => $val)
{
extract($val);
$html .= "<h2>$position: $blurb</h2>\n";

$arrGuidelines = $db->GetAllRows("select distinct * from lk_guideline where parent_id = ?", [$id]);
foreach($arrGuidelines as $key1 => $val1)
{
extract($val1);
$html .= "<h3>$position: $blurb</h3>\n";

$arrCriterion = $db->GetAllRows("select distinct * from lk_criterion where parent_id = ?", [$id]);
foreach($arrCriterion as $key2 => $val2)
{
extract($val2);
$html .= "<h4>$position: $blurb</h4>\n<ul>\n";

$arrTests = $db->GetAllRows("select distinct * from lk_test where parent_id = ?", [$id]);
foreach($arrTests as $key3 => $val3)
{
extract($val3);
$html .= "<li>$position: $blurb</li>\n";
} //foreach

$html .= "</ul>\n";
} //foreach
} //foreach
} //foreach

echo $html;
?>