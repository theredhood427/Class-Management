<?php
include ("../init.php");
use Models\Teacher;
use Models\Classes;
//
$employee_id = $_GET['employee_id'];
$teacher= new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$teacher->getById($employee_id);
//
$employee_number= $teacher->getEmployeeNumber();
$first_name = $teacher->getFirstName();
$last_name = $teacher->getLastName();
//
$all_teachers = $teacher->viewClasses($employee_id);
//
$template = $mustache->loadTemplate('teacher/view.mustache');
echo $template->render((compact('all_teacher','first_name','last_name', 'employee_id')));
?>