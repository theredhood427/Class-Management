<?php
include ("../init.php");
use Models\Student;
use Models\Classes;
//
$student_id = $_GET['id'];
$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($student_id);
//
$student_id= $student->getStudentNumber();
$first_name = $student->getFirstName();
$last_name = $student->getLastName();
//
$all_students = $student->viewClasses($id);
//
$template = $mustache->loadTemplate('student/view.mustache');
echo $template->render((compact('all_students','first_name','last_name')));
?>