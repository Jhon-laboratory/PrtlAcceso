<?php
session_start();
if (!$_SESSION["logueado"] == TRUE) {
	header("Location: ../index.php");
}
?>