<?php
include_once("config.php");
include_once("SDK/init.php");
header("Location: ".getDownloadUrl($_REQUEST['key']));