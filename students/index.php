<?php

include ("../init.php");
use Models\Student;

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_Students = $student->getAll();
var_dump($all_Students);