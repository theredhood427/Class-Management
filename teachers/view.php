<?php

include "../init.php";
use Models\Teacher;

$id = $_GET['id']??null;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$teacher->getById($id);
$first_name = $teacher->getFirstName();
$last_name = $teacher->getLastName();
$employee_number = $teacher->getEmployeeNumber();
$teacherClass = $teacher->viewClass();

// var_dump($first_name, $last_name, $employee_number, $teacherClass);
// exit();

$template = $mustache->loadTemplate('teacher/view.mustache');
echo $template->render(compact('teacherClass', 'employee_number', 'first_name', 'last_name'));