<?php
class ReportTool
{
function __construct()
{
$this->db = new PDO('mysql:host=localhost;dbname=accesseq_wcag;charset=utf8', 'accesseq_su', 'Warszawa99+');
$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($this->user_type))
{
$this->GetCredentials();
} //logged in
} //constructor

function __destruct()
{
unset($this->db);
} //destructor

function __sleep()
{
unset($this->db);
} //sleep

function __wakeup()
{
$this->db = new PDO('mysql:host=localhost;dbname=accesseq_wcag;charset=utf8', 'accesseq_su', 'Warszawa99+');
$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} //wakeup

//--------------------------------------------------
//Database functions

private function _Query($sql, $params=null)
{
try {
$stmt = $this->db->prepare($sql);
if ($params == null)
{
$stmt->execute();
} else {
$stmt->execute($params);
} //if

return $stmt;
} catch (PDOException $e) {
    echo 'Error: : ' . $e->getMessage();
return false;
} //try-catch
} //select

private function GetRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->fetch(PDO::FETCH_ASSOC);
} //GetRow

private function GetAllRows($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
} //GetAllRows

private function GetCount($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

return $row[0];
} //GetCount

private function AddRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $this->db->lastInsertId();
} //AddRow

private function EditRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->rowCount();
} //EditRow

//--------------------------------------------------
//Credentials functions

function GetCredentials()
{
if (!isset($_SERVER['PHP_AUTH_USER']))
{
header('WWW-Authenticate: Basic realm="Online reporting system"');
header('HTTP/1.0 401 Unauthorized');
echo "<p>You are not authorised to use this page.</p>";
exit();
} else {
$this->ProcessCredentials();
} //if
} //GetCredentials

function ProcessCredentials()
{
$sql = "select * from staff where first_name = ? and password = ?";
$params = [$_SERVER['PHP_AUTH_USER'], md5($_SERVER['PHP_AUTH_PW'])];
$record = $this->GetRow($sql, $params);

if (is_array($record)) //the login was correct
{
$this->user_type = "staff";
foreach($record as $key => $val)
{
$this->$key = $val;
} //foreach
} else {
unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);
$this->GetCredentials();
} //if the login was correct
} //ProcessCredentials

//--------------------------------------------------
//Country functions

public function GetCountries()
{
$html = "";
$rows = $this->GetAllRows("select id, country_name from lk_country order by country_name");
foreach($rows as $val)
{
extract($val);
($country_name == "United Kingdom") ? $sel = " selected=\"selected\"" : $sel = "";
$html .= "<option$sel value=\"$id\">$country_name</option>\n";
} //foreach

return $html;
} //GetCountries

//--------------------------------------------------
//Company functions

protected function FormatAddress($company)
{
extract($company);
$address = "";

if ($address1 != "") $address = $address1;
if ($address2 != "") $address .= ", " . $address2;
if ($address3 != "") $address .= ", " . $address3;
if ($town!= "") $address .= ", " . $town;
if ($county!= "") $address .= ", " . $county;
if ($zip != "") $address .= ", " . $zip;
if ($country_name != "") $address .= ", " . $country_name;

return $address;
} //FormatAddress

public function GetCompany($id)
{
$company = $this->GetRow("select * from vw_company where id=?", [$id]);
$company['address'] = $this->FormatAddress($company);
return $company;
} //GetCompany

public function GetCompanies($html_type="option")
{
$html = "";
$rows = $this->GetAllRows("select id, company_name from company");
foreach($rows as $val)
{
extract($val);
if ($html_type == "option")
{
$html .= "<option value=\"$id\">$company_name</option>\n";
} else {
$html .= "<li><a href=\"company.php?id=$id\">$company_name</a></li>\n";
} //if
} //foreach

return $html;
} //GetCompanies

public function AddCompany($data)
{
foreach($data as $key => $val)
$params[":" . $key] = $val;
$sql = "insert into company
(company_name, address1, address2, address3, town, county, zip, country_id, phone, created_by_id)
values
(:company_name, :address1, :address2, :address3, :town, :county, :zip, :country_id, :phone, :created_by_id)";

return $this->AddRow($sql, $params);
} //AddCompany

//--------------------------------------------------
//User functions
public function GetUser($id)
{
$user = $this->GetRow("select * from vw_user where id=?", [$id]);
return $user;
} //GetUser

public function GetUsers($html_type="option")
{
$html = "";
$rows = $this->GetAllRows("select * from vw_user");
foreach($rows as $val)
{
extract($val);
if ($html_type == "option")
{
$html .= "<option value=\"$id\">$User_name</option>\n";
} else {
$html .= "<li><a href=\"User.php?id=$id\">$User_name</a></li>\n";
} //if
} //foreach

return $html;
} //GetUsers

public function AddUser($data)
{
foreach($data as $key => $val)
$params[":" . $key] = $val;
$sql = "insert into user
(created_by_id, company_id, privileges, first_name, last_name, email, phone)
values
(:created_by_id, :company_id, :privileges, :first_name, :last_name, :email, :phone)";

return $this->AddRow($sql, $params);
} //AddUser
} //class

//Now instantiate the class in the session
session_start();
if (!$_SESSION['reptool'] instanceof ReportTool)
$_SESSION['reptool'] = new ReportTool();
?> 