<?php

include ("../init.php");
use Models\Class;

$class= new Student('', '', '', '', '', '');
$class->setConnection($connection);
$all_classes = $class->getAll();

$template = $mustache->loadTemplate('classes/index.mustache');
echo $template->render(compact('all_classes'));