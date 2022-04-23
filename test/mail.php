<?php
session_start();
$rand = $_SESSION['code'];
unset($_SESSION['code']);

echo $rand;

?>