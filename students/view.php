<?php

include "../init.php";
use Models\Student;

$id = $_GET['id']??null;

$student = new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($id);
$first_name = $student->getFirstName();
$last_name = $student->getLastName();
$student_number = $student->getStudentNumber();
$studentClass = $student->viewClass();

// var_dump($first_name, $last_name, $student_number, $studentClass);
// exit();

$template = $mustache->loadTemplate('student/view.mustache');
echo $template->render(compact('studentClass', 'student_number', 'first_name', 'last_name'));