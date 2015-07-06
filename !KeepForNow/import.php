<?php
$principle = 0;
$guideline = 0;
$criterion = 0;

$arrPrinciples = [];
$arrGuidelines = [];
$arrCriteria = [];
$arrTests = [];

$strRaw = file_get_contents("raw_data.txt");
$arrRaw = split("\r\n", $strRaw);
unset($strRaw);

foreach($arrRaw as $row)
{
$fields = split("\t", $row);
$level = count(preg_split("/[-\.]/", $fields[1]));

//Trim the white space from each field
foreach($fields as $key => $val)
	$fields[$ke] = trim($fields[$key]);

switch($level)
{
case 1:
if ($fields[0] != "")
{
$principle++;
	$arrPrinciples[count($arrPrinciples)+1] = $fields[0];
} //if
break;

case 2:
$guideline = $fields[1];
$arrGuidelines[$fields[1]]['parent'] = $principle;
$arrGuidelines[$fields[1]]['blurb'] = $fields[2];
break;

case 3:
$criterion = $fields[1];
$arrCriteria[$fields[1]]['parent'] = $guideline;
$arrCriteria[$fields[1]]['level'] = $fields[0];
$arrCriteria[$fields[1]]['blurb'] = $fields[2];
break;

case 4:
$arrTests[$fields[1]]['parent'] = $criterion;
$arrTests[$fields[1]]['blurb'] = $fields[2];
break;
} //switch
} //foreach

require_once("class.db.php");
$db = new DB;

//Add the principles
$sql = "insert into lk_principle (position, blurb) values(?, ?)";

foreach($arrPrinciples as $key => $val)
{
//$db->AddRow($sql, [$key, $val]);
} //foreach
/*
//Now add the guidelines
$sql = "insert into lk_guideline(parent, position, blurb) values(?, ?, ?)";

foreach($arrGuidelines as $key => $val)
{
$params = [$val['parent'], $key, $val['blurb']];
echo $db->AddRow($sql, $params);
} //foreach
*/

//Now add the criteria
/*
$sql = "insert into lk_criterion (parent, position, level, blurb) values(?, ?, ?, ?)";

foreach($arrCriteria as $key => $val)
{
$params = [$val['parent'], $key, $val['level'], $val['blurb']];
echo $db->AddRow($sql, $params);
//print_r($params);
} //foreach
*/

//Now add the tests
/*
$sql = "insert into lk_test (parent, position, blurb) values(?, ?, ?)";

foreach($arrTests as $key => $val)
{
$params = [$val['parent'], $key, $val['blurb']];
echo $db->AddRow($sql, $params);
//print_r($params);
} //foreach
*/
?>