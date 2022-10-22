<?php

include "../init.php";
use Models\Teacher;

$id = $_GET['id']??null;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$teacher = $teacher->fetchTeacher($id);

$template = $mustache->loadTemplate('teacher/edit.mustache');
echo $template->render(compact('teacher'));


try {
    if(isset($_POST['first_name'])){
        $updateTeacher = new Teacher('', '', '', '', '');
        $updateTeacher->setConnection($connection);
        $updateTeacher->getById(($_POST['id']));
        //var_dump($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['employee_number'], $_POST['contact_number']);
        //exit();
        $updateTeacher->update($_POST['first_name'], $_POST['last_name'], $_POST['employee_number'], $_POST['email'], $_POST['contact_number']);
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
} catch (Exception $e) {
    error_log( $e->getMessage());
}