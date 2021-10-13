<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\EmailRectifier;
use MigrationTool\Rectifier\NameRectifier;
use MigrationTool\Validator\DataValidator;

var_dump(DataValidator::isPhoneNumberValid('0625227931'));

/*$name = "Standbridge Ciron";
var_dump(NameRectifier::SEPARATE($name));*/

//var_dump(NameRectifier::SEPARATE($name2));
//$name2 = "Jean-baptiste Standbridge Henry";
/*$email = "james@gmail.fr";
$new = EmailRectifier::emailRectifier($email);
var_dump($new);*/