<?php

if($_GET){
	echo "<pre>";
	echo "get<br/>";
	var_dump($_GET);
	echo "</pre>";
}
if($_POST){
	echo "<pre>";
	echo "post<br/>";
	var_dump($_POST);
	echo "</pre>";
}