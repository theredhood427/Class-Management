<?php

include ("../init.php");
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_Teachers = $teacher->getAll();
var_dump($all_Teachers);