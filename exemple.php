<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\EmailRectifier;
use MigrationTool\Rectifier\NameRectifier;
use MigrationTool\Validator\DataValidator;
use MigrationTool\Rectifier\PhoneRectifier;

//var_dump(DataValidator::isPhoneNumberValid('0625227931'));

/*$name = "Standbridge Ciron";
var_dump(NameRectifier::SEPARATE($name));*/

//var_dump(NameRectifier::SEPARATE($name2));
//$name2 = "Jean-baptiste Standbridge Henry";
/*$email = "james@gmail.fr";
$new = EmailRectifier::emailRectifier($email);
var_dump($new);*/

dd(PhoneRectifier::normalizePhoneNumber("+806 45 34 28 98"));