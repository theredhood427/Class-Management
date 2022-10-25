<?php
include ("../init.php");
use Models\ClassRoster;
use Models\Classes;

$class_code =($_GET['class_code']);
$class_roster= new ClassRoster('', '');
$class_roster->setConnection($connection);

$class_students=$class_roster->viewRoster($class_code);
// var_dump($class_students, $class_code);
// exit();
$template = $mustache->loadTemplate('classroster/edit.mustache');
echo $template->render((compact('class_code','class_students')));
?>
