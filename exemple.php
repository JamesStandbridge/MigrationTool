<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\EmailRectifier;

$email = "james@tiscali.com";
$new = EmailRectifier::emailRectifier($email);
var_dump($new);