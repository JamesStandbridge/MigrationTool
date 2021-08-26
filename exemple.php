<?php

require 'vendor/autoload.php';

use MigrationTool\Rectifier\DataRectifier;

$email = "james@gmail.fr";
$new = DataRectifier::emailRectifier($email);
var_dump($new);