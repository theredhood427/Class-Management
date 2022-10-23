<?php

include ("../init.php");
use Models\Classes;

$classes= new Classes('', '', '', '');
$classes->setConnection($connection);
$all_classes = $classes->showClasses();

$template = $mustache->loadTemplate('classes/index.mustache');
echo $template->render(compact('all_classes'));