<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\EmailRectifier;
use MigrationTool\Rectifier\NameRectifier;

$name = "PAPROCKI KARINE";
//$name2 = "Jean-baptiste Standbridge Henry";
var_dump(NameRectifier::SEPARATE($name));
//var_dump(NameRectifier::SEPARATE($name2));

/*$email = "james@gmail.fr";
$new = EmailRectifier::emailRectifier($email);
var_dump($new);*/