<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin-panel/resources/config.php");
require_once(LIBRARY_PATH."/db.class.php");
$db = new DB();
$db->query("DELETE FROM $_GET[name] WHERE $_GET[idName] = $_GET[id]");
?>