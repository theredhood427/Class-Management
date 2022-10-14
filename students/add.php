<?php

include ("../init.php");
use Models\Student;

$student= new Student('Ron', 'Russelle', '14-0904-328', 'bangsil.ronrusselle@auf.edu.ph', '09159536887', 'BSIT');
$student->setConnection($connection);
$all_Students = $student->save();
var_dump($student);