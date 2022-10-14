<?php

include ("../init.php");
use Models\Teacher;

$teacher= new Teacher('Kane', 'Erryl', 'kane.erryln@auf.edu.ph', '09429900320', '00-1234-568');
$teacher->setConnection($connection);
$all_Teachers = $teacher->save();
var_dump($teacher);