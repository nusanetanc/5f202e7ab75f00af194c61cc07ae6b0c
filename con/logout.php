<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["level"]);
header('location:'.$base_url);
?>