<?php

include "../init.php";
use Models\Classes;

$id = $_GET['id']??null;

try {
    if(isset($_GET['id'])){
        $class = new Classes('', '', '', '');
        $class->setConnection($connection);
        $class->getById($id);
        $class->delete();
        echo "<script>window.location.href='index.php?success=3';</script>";
        exit();
    }
} catch (Exception $e) {
    error_log( $e->getMessage());
}