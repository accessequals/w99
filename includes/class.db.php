<?php
class DB {
function __construct()
{
$this->db = new PDO('mysql:host=localhost;dbname=accesseq_wcag;charset=utf8', 'accesseq_su', 'Warszawa99+');
$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} //constructor

function _Query($sql, $params=null)
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

function GetRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->fetch(PDO::FETCH_ASSOC);
} //GetRow

function GetAllRows($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
} //GetAllRows

function GetCount($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

return $row[0];
} //GetCount

function AddRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $this->db->lastInsertId();
} //AddRow

function EditRow($sql, $params=null)
{
$stmt = $this->_Query($sql, $params);
return $stmt->rowCount();
} //EditRow
} //class
?>