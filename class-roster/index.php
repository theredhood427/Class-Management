<?php
include ("../init.php");
use Models\ClassRoster;
use Models\Classes;

$class_roster= new ClassRoster('', '');
$class_roster->setConnection($connection);
$all_rosters = $class_roster->showRosters(); 
// var_dump($all_rosters);
// exit(); 

$template = $mustache->loadTemplate('classroster/index.mustache');
echo $template->render((compact('all_rosters')));
?>