<?php

include "../init.php";
use Models\Classes;
use Models\Teacher;

$id = $_GET['id']??null;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAll();

$class = new Classes('', '', '', '');
$class->setConnection($connection);
$class = $class->getClass($id);

// var_dump($class);
// exit();


$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/classes')
]);

$template = $mustache->loadTemplate('edit');
echo $template->render(compact('all_teachers','class'));

try {
    if(isset($_POST['id'])){
        $update_class = new Classes('', '', '', '');
        $update_class->setConnection($connection);
        $update_class->getById(intval($_POST['id']));

        // var_dump($_POST['name'], $_POST['description'], $_POST['class_code'], $_POST['employee_number']);
        // exit();
        $update_class->update($_POST['name'], $_POST['description'], $_POST['class_code'], $_POST['employee_number']);
        echo "<script>window.location.href='index.php?success=2';</script>";
        exit();
    }
} catch (Exception $e) {
    error_log( $e->getMessage());
}