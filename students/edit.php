<?php

include "../init.php";
use Models\Student;

$id = $_GET['id']??null;

$student = new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student = $student->fetchStudent($id);

$template = $mustache->loadTemplate('student/edit.mustache');
echo $template->render(compact('student'));


try {
    if(isset($_POST['first_name'])){
        $update_student = new Student('', '', '', '', '', '');
        $update_student->setConnection($connection);
        $update_student->getById(intval($_POST['id']));
        //var_dump($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['student_number'], $_POST['contact_number'], $_POST['program']);
        //exit();
       $update_student->update($_POST['first_name'], $_POST['last_name'], $_POST['student_number'], $_POST['email'], $_POST['contact_number'], $_POST['program']);
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
} catch (Exception $e) {
    error_log( $e->getMessage());
}