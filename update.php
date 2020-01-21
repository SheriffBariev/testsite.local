<?php
require_once("dbconnect.php");
function pdoSet($allowed, &$values, $source = array()) {
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST;
    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
            $values[$field] = $source[$field];
        }
    }
    return substr($set, 0, -2);
}
$allowed = array(
    "LastName",
    "FirstName",
    "MiddleName",
    "Age",
    "Address",
    "email",
    "phonenumber");
$values = array(
    $_POST['LastName'],
    $_POST['FirstName'],
    $_POST['MiddleName'],
    $_POST['Age'],
    $_POST['Address'],
    $_POST['email'],
    $_POST['phonenumber']);
$sql = "UPDATE requests SET " . pdoSet($allowed, $values) . " WHERE id = :id";
$stm = $pdo->prepare($sql);
$values["id"] = $_POST['id'];
$stm->execute($values);
$result = $stm->fetchObject();
if ($result->total > 0) {
    header("refresh:0.5; url=requests.php");
} else {
    echo "Данные не обновлены, просьба заполнить все поля.";
}

