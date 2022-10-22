<?php

include ("../init.php");
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAll();
//var_dump($all_teachers);
//exit();
$template = $mustache->loadTemplate('teacher/index.mustache');
echo $template->render(compact('all_teachers'));