<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\EmailRectifier;
use MigrationTool\Rectifier\NameRectifier;

$name = "STANDBRIDGEjames";
$name2 = "Jean-Baptiste PaulStandbridge Henry";
//var_dump(NameRectifier::SEPARATE($name));
var_dump(NameRectifier::SEPARATE($name2));
/*
$email = "james@tiscali.com";
$new = EmailRectifier::emailRectifier($email);
var_dump($new);*/