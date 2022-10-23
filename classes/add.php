<?php

include "../init.php";
use Models\Classes;
use Models\Teacher;

$teacher = new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAll();

$template = $mustache->loadTemplate('classes/add.mustache');
echo $template->render(compact('all_teachers'));

try {
    if(isset($_POST['name'])){
        $class = new Classes($_POST["name"],$_POST["class_code"],$_POST["description"],$_POST["employee_number"]);
        // var_dump($class->getClassName(),$class->getDescription(),$class->getClassCode(),$class->fetchTeacherId());
        // exit();
        $class->setConnection($connection);
        $class->addClass();
        echo "<script>window.location.href='index.php?success=1';</script>";

    }
} catch (Exception $e) {
    error_log( $e->getMessage());
}