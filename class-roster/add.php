<?php
include ("../init.php");
use Models\ClassRoster;
use Models\Classes;
use Models\Student;

$class_code = $_GET['class_code'];


$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$showStudents = $student->getAll();
// var_dump($showStudents);
// exit();

$template = $mustache->loadTemplate('classroster/add.mustache');
echo $template->render(compact('showStudents', 'class_code'));


try {
    if (isset($_POST['class_code'])) {
        // var_dump($_POST['class_code'],$_POST['student_number']);
        // exit();
        $addRoster = new ClassRoster($_POST['class_code'], $_POST['student_number']);
        $addRoster->setConnection($connection);
        $addRoster->addRoster();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}

?>